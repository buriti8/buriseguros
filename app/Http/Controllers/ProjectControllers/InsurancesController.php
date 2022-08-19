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
use Illuminate\Support\Str;

class InsurancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = [];

        if ($request->has('q')) {
            $search = $request->get('q', []);
        } else {
            $search = get_last_user_search('insurances', []);
        }

        set_last_user_search('insurances', $search);

        $per_page = module_per_page('insurances', 20);
        $insurances = Insurance::search($search)->paginate($per_page);
        $insurances->appends($search + ['per_page' => $per_page]);

        return view('insurances.index', [
            'search' => $search,
            'insurances' => $insurances,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Insurance $insurances)
    {
        return view("insurances.create", [
            'insurances' => $insurances,
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

            $insurances = new Insurance($request->validated());

            if ($insurances->save()) {
                $insurances->slug = Str::slug($insurances->name) . '-' . $insurances->id;
                $insurances->save();

                Session::flash('success', __('insurances.created', ['name' => $insurances->name]));
                DB::commit();
            } else {
                Session::flash('error', __('insurances.error', ['name' => $insurances->name, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('insurances.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insurances = Insurance::findOrFail($id);

        return view("insurances.edit", [
            'insurances' => $insurances,
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

            $insurances = Insurance::findOrFail($id);
            $insurances->slug = Str::slug($insurances->name) . '-' . $insurances->id;

            if ($insurances->update($request->validated())) {
                Session::flash('success', __('insurances.updated', ['name' => $insurances->name]));
                DB::commit();
            } else {
                Session::flash('error', __('insurances.error', ['name' => $insurances->name, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('insurances.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insurances = Insurance::findOrFail($id);

        try {
            $insurances->delete();
            Session::flash('success', __('insurances.deleted', ['name' => $insurances->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('insurances.delete_error', ['name' => $insurances->name]));
        }

        return redirect()->route('insurances.index');
    }

    public function getImage(Insurance $insurance)
    {
        if ($insurance->image) {
            return response()->file(storage_path("app/" . $insurance->image));
        } else {
            abort(404);
        }
    }
}
