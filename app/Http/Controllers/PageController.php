<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Insurance;
use App\Models\Insurer;
use App\Models\Network;
use App\Models\Post;
use App\Models\Solution;
use App\PList;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurers = Insurer::status()->get();
        $insurances = Insurance::status()->get();
        $solutions = Solution::status()->get();
        $recent_posts = Post::status()->latest()->take(3)->get();
        $contact = Contact::findOrFail(1);

        return view('page.index', [
            'insurers' => $insurers,
            'solutions' => $solutions,
            'recent_posts' => $recent_posts,
            'insurances' => $insurances,
            'contact' => $contact,
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
