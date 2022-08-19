<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use App\Models\Network;
use App\Models\Post;
use App\PList;
use Illuminate\Http\Request;

class BlogController extends Controller
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
                $search = get_last_user_search('posts', []);
            } else {
                $search = [];
            }
        }

        set_last_user_search('posts', $search);

        $per_page = module_per_page('posts', 6);
        $posts = Post::search($search)->paginate(6);
        $posts->appends($search + ['per_page' => $per_page]);
        
        $recent_posts = Post::status()->latest()->take(3)->get();
        $categories = PList::status()->Options('categories')->withCount('posts')->get();
        $networks = Network::status()->get();
        $insurers = Insurer::status()->get();

        return view('blog.index', [
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'networks' => $networks,
            'insurers' => $insurers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $recent_posts = Post::status()->latest()->take(3)->get();
        $categories = PList::status()->Options('categories')->withCount('posts')->get();
        $networks = Network::status()->get();
        $insurers = Insurer::status()->get();

        return view('blog.show', [
            'post' => $post,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'networks' => $networks,
            'insurers' => $insurers,
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
