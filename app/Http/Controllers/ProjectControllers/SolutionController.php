<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSolutionRequest;
use App\Http\Requests\UpdateSolutionRequest;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SolutionController extends Controller
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
            $search = get_last_user_search('solutions', []);
        }

        set_last_user_search('solutions', $search);

        $per_page = module_per_page('solutions', 20);
        $solutions = Solution::search($search)->paginate($per_page);
        $solutions->appends($search + ['per_page' => $per_page]);

        return view('solutions.index', [
            'search' => $search,
            'solutions' => $solutions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Solution $solutions)
    {
        return view("solutions.create", [
            'solutions' => $solutions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSolutionRequest $request)
    {
        try {
            DB::beginTransaction();

            $solutions = new Solution($request->validated());

            if ($solutions->save()) {
                Session::flash('success', __('solutions.created', ['name' => $solutions->name]));
                DB::commit();
            } else {
                Session::flash('error', __('solutions.error', ['name' => $solutions->name, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('solutions.index');
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
        $solutions = Solution::findOrFail($id);

        return view("solutions.edit", [
            'solutions' => $solutions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSolutionRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $solutions = Solution::findOrFail($id);

            if ($solutions->update($request->validated())) {
                Session::flash('success', __('solutions.updated', ['name' => $solutions->name]));
                DB::commit();
            } else {
                Session::flash('error', __('solutions.error', ['name' => $solutions->name, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('solutions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solutions = Solution::findOrFail($id);

        try {
            $solutions->delete();
            Session::flash('success', __('solutions.deleted', ['name' => $solutions->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('solutions.delete_error', ['name' => $solutions->name]));
        }

        return redirect()->route('solutions.index');
    }

    public function getImage(Solution $solution)
    {
        if ($solution->image) {
            $img = \Image::make(storage_path("app/" . $solution->image))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            return $img->response($img->extension);
        } else {
            abort(404);
        }
    }
}
