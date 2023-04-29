<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->has('q') ? $request->get('q') : [];
        } else {
            if ($request->has('page')) {
                $search = get_last_user_search('insurances', []);
            } else {
                $search = [];
            }
        }

        set_last_user_search('insurances', $search);

        $per_page = module_per_page('insurances', 20);
        $insurances = Insurance::search($search)->paginate($per_page);
        $insurances->appends($search + ['per_page' => $per_page]);

        return view('insurances.index', [
            'search' => $search,
            'insurances' => $insurances,
        ] + Insurance::getArrayList());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Insurance $insurance)
    {
        return view("insurances.create", [
            'insurance' => $insurance,
        ] + Insurance::getArrayList());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInsuranceRequest $request)
    {
        try {
            DB::beginTransaction();

            $insurance = new Insurance($request->validated());

            if ($insurance->save()) {
                Session::flash('success', __('insurances.created', ['name' => $insurance->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('insurances.error', ['name' => $insurance->name, 'action' => 'crear']));
        }

        if ($insurance) {
            return redirect()->route('insurances.show', $insurance->id);
        } else {
            return redirect()->route('insurances.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insurance = Insurance::findOrFail($id);

        return view('insurances.detail', [
            'insurance' => $insurance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insurance = Insurance::findOrFail($id);

        return view("insurances.edit", [
            'insurance' => $insurance,
        ] + Insurance::getArrayList());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsuranceRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $insurance = Insurance::findOrFail($id);

            if ($insurance->update($request->validated())) {
                Session::flash('success', __('insurances.updated', ['name' => $insurance->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('insurances.error', ['name' => $insurance->name, 'action' => 'actualizar']));
        }

        if ($insurance->wasChanged('status')) {
            return redirect()->route('insurances.index');
        }

        return redirect()->route('insurances.show', $insurance->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insurance = Insurance::findOrFail($id);

        try {
            $insurance->delete();
            Session::flash('success', __('insurances.deleted', ['name' => $insurance->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('insurances.error', ['name' => $insurance->name]));
        }

        return redirect()->route('insurances.index');
    }

    public function getImage(Insurance $insurance)
    {
        if ($insurance->image) {
            $img = Image::make(storage_path("app/" . $insurance->image))->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            return $img->response($img->extension);
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        $insurances = Insurance::status()->get();

        return view('insurances.page.detail', [
            'insurances' => $insurances,
        ]);
    }
}
