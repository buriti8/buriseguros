<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\Information;
use App\Models\Insurance;
use App\Models\Insurer;
use App\Models\Solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $solutions = Solution::status()->orderBy('name', 'DESC')->get();
        $information = Information::get()->first();

        return view('page.index', [
            'insurers' => $insurers,
            'solutions' => $solutions,
            'insurances' => $insurances,
            'information' => $information,
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
        try {
            DB::beginTransaction();

            $contact_form = new ContactForm($request->all());

            if ($contact_form->save()) {
                $data = [
                    'success' => true,
                    'message' => __('contact_forms.success'),
                ];

                DB::commit();
            }
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => __('contact_forms.error'),
            ];

            DB::rollBack();
            Log::error($e->getMessage());
        }

        return response()->json($data);
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
