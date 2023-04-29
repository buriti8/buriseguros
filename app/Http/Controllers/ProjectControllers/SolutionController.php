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
use Intervention\Image\ImageManagerStatic as Image;

class SolutionController extends Controller
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
                $search = get_last_user_search('solutions', []);
            } else {
                $search = [];
            }
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
    public function create(Solution $solution)
    {
        return view("solutions.create", [
            'solution' => $solution,
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

            $solution = new Solution($request->validated());

            if ($solution->save()) {
                Session::flash('success', __('solutions.created', ['name' => $solution->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('solutions.error', ['name' => $solution->name, 'action' => 'crear']));
        }

        if ($solution) {
            return redirect()->route('solutions.show', $solution->id);
        } else {
            return redirect()->route('solutions.index');
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
        $solution = Solution::findOrFail($id);

        return view('solutions.detail', [
            'solution' => $solution,
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
        $solution = Solution::findOrFail($id);

        return view("solutions.edit", [
            'solution' => $solution,
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

            $solution = Solution::findOrFail($id);

            if ($solution->update($request->validated())) {
                Session::flash('success', __('solutions.updated', ['name' => $solution->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('solutions.error', ['name' => $solution->name, 'action' => 'actualizar']));
        }

        if ($solution->wasChanged('status')) {
            return redirect()->route('solutions.index');
        }

        return redirect()->route('solutions.show', $solution->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solution = Solution::findOrFail($id);

        try {
            $solution->delete();
            Session::flash('success', __('solutions.deleted', ['name' => $solution->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('solutions.error', ['name' => $solution->name]));
        }

        return redirect()->route('solutions.index');
    }

    public function getImage(Solution $solution)
    {
        if ($solution->image) {
            $img = Image::make(storage_path("app/" . $solution->image))->resize(500, null, function ($constraint) {
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
        $solutions = Solution::status()->get();

        return view('solutions.page.detail', [
            'solutions' => $solutions,
        ]);
    }
}
