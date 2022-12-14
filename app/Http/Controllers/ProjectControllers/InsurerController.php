<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInsurerRequest;
use App\Http\Requests\UpdateInsurerRequest;
use App\Models\Insurer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class InsurerController extends Controller
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
            $search = get_last_user_search('insurers', []);
        }

        set_last_user_search('insurers', $search);

        $per_page = module_per_page('insurers', 20);
        $insurers = Insurer::search($search)->paginate($per_page);
        $insurers->appends($search + ['per_page' => $per_page]);

        return view('insurers.index', [
            'search' => $search,
            'insurers' => $insurers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Insurer $insurers)
    {
        return view("insurers.create", [
            'insurers' => $insurers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInsurerRequest $request)
    {
        try {
            DB::beginTransaction();

            $insurers = new Insurer($request->validated());

            if ($insurers->save()) {
                Session::flash('success', __('insurers.created', ['name' => $insurers->name]));
                DB::commit();
            } else {
                Session::flash('error', __('insurers.error', ['name' => $insurers->name, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('insurers.index');
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
        $insurers = Insurer::findOrFail($id);

        return view("insurers.edit", [
            'insurers' => $insurers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsurerRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $insurers = Insurer::findOrFail($id);

            if ($insurers->update($request->validated())) {
                Session::flash('success', __('insurers.updated', ['name' => $insurers->name]));
                DB::commit();
            } else {
                Session::flash('error', __('insurers.error', ['name' => $insurers->name, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('insurers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insurers = Insurer::findOrFail($id);

        try {
            $insurers->delete();
            Session::flash('success', __('insurers.deleted', ['name' => $insurers->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('insurers.delete_error', ['name' => $insurers->name]));
        }

        return redirect()->route('insurers.index');
    }

    public function getImage(Insurer $insurer)
    {
        if ($insurer->image) {
            $img = \Image::make(storage_path("app/" . $insurer->image))->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            return $img->response($img->extension);
        } else {
            abort(404);
        }
    }
}
