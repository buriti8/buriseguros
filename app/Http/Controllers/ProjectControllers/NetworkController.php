<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNetworkRequest;
use App\Http\Requests\UpdateNetworkRequest;
use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class NetworkController extends Controller
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
            $search = get_last_user_search('networks', []);
        }

        set_last_user_search('networks', $search);

        $per_page = module_per_page('networks', 20);
        $networks = Network::search($search)->paginate($per_page);
        $networks->appends($search + ['per_page' => $per_page]);

        return view('networks.index', [
            'search' => $search,
            'networks' => $networks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Network $networks)
    {
        return view("networks.create", [
            'networks' => $networks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNetworkRequest $request)
    {
        try {
            DB::beginTransaction();

            $networks = new Network($request->validated());

            if ($networks->save()) {
                Session::flash('success', __('networks.created', ['name' => $networks->name]));
                DB::commit();
            } else {
                Session::flash('error', __('networks.error', ['name' => $networks->name, 'action' => 'crear']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('networks.index');
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
        $networks = Network::findOrFail($id);

        return view("networks.edit", [
            'networks' => $networks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNetworkRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $networks = Network::findOrFail($id);

            if ($networks->update($request->validated())) {
                Session::flash('success', __('networks.updated', ['name' => $networks->name]));
                DB::commit();
            } else {
                Session::flash('error', __('networks.error', ['name' => $networks->name, 'action' => 'actualizar']));
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('networks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $networks = Network::findOrFail($id);

        try {
            $networks->delete();
            Session::flash('success', __('networks.deleted', ['name' => $networks->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('networks.delete_error', ['name' => $networks->name]));
        }

        return redirect()->route('networks.index');
    }
}
