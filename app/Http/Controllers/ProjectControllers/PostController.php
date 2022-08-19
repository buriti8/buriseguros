<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostController extends Controller
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
            $search = get_last_user_search('posts', []);
        }

        set_last_user_search('posts', $search);

        $per_page = module_per_page('posts', 20);
        $posts = Post::search($search)->paginate($per_page);
        $posts->appends($search + ['per_page' => $per_page]);

        return view('posts.index', [
            'search' => $search,
            'posts' => $posts,
        ] + Post::getArrayList());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $posts)
    {
        return view("posts.create", [
            'posts' => $posts,
        ] + Post::getArrayList());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $posts = new Post($request->validated());

            if ($posts->save()) {
                $posts->slug = Str::slug($posts->title) . '-' . $posts->id;
                $posts->save();
                
                Session::flash('success', __('posts.created', ['title' => $posts->title]));
                DB::commit();
            } else {
                Session::flash('error', __('posts.error', ['title' => $posts->title, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('posts.index');
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
        $posts = Post::findOrFail($id);

        return view("posts.edit", [
            'posts' => $posts,
        ] + Post::getArrayList());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $posts = Post::findOrFail($id);
            $posts->slug = Str::slug($posts->title) . '-' . $posts->id;

            if ($posts->update($request->validated())) {
                Session::flash('success', __('posts.updated', ['title' => $posts->title]));
                DB::commit();
            } else {
                Session::flash('error', __('posts.error', ['title' => $posts->title, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);

        try {
            $posts->delete();
            Session::flash('success', __('posts.deleted', ['title' => $posts->title]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('posts.delete_error', ['title' => $posts->title]));
        }

        return redirect()->route('posts.index');
    }

    public function getImage(Post $post)
    {
        if ($post->image) {
            return response()->file(storage_path("app/" . $post->image));
        } else {
            abort(404);
        }
    }
}
