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
use Intervention\Image\ImageManagerStatic as Image;

class InsurerController extends Controller
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
                $search = get_last_user_search('insurers', []);
            } else {
                $search = [];
            }
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
    public function create(Insurer $insurer)
    {
        return view("insurers.create", [
            'insurer' => $insurer,
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

            $insurer = new Insurer($request->validated());

            if ($insurer->save()) {
                Session::flash('success', __('insurers.created', ['name' => $insurer->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('insurers.error', ['name' => $insurer->name, 'action' => 'crear']));
        }

        if ($insurer) {
            return redirect()->route('insurers.show', $insurer->id);
        } else {
            return redirect()->route('insurers.index');
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
        $insurer = Insurer::findOrFail($id);

        return view('insurers.detail', [
            'insurer' => $insurer,
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
        $insurer = Insurer::findOrFail($id);

        return view("insurers.edit", [
            'insurer' => $insurer,
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

            $insurer = Insurer::findOrFail($id);

            if ($insurer->update($request->validated())) {
                Session::flash('success', __('insurers.updated', ['name' => $insurer->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('insurers.error', ['name' => $insurer->name, 'action' => 'actualizar']));
        }

        if ($insurer->wasChanged('status')) {
            return redirect()->route('insurers.index');
        }

        return redirect()->route('insurers.show', $insurer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insurer = Insurer::findOrFail($id);

        try {
            $insurer->delete();
            Session::flash('success', __('insurers.deleted', ['name' => $insurer->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('insurers.error', ['name' => $insurer->name]));
        }

        return redirect()->route('insurers.index');
    }

    public function getImage(Insurer $insurer)
    {
        if ($insurer->image) {
            $img = Image::make(storage_path("app/" . $insurer->image));

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
        $insurers = Insurer::status()->get();

        return view('insurers.page.detail', [
            'insurers' => $insurers,
        ]);
    }
}
