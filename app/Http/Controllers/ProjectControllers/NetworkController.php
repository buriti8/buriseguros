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
        if ($request->has('q')) {
            $search = $request->has('q') ? $request->get('q') : [];
        } else {
            if ($request->has('page')) {
                $search = get_last_user_search('networks', []);
            } else {
                $search = [];
            }
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
    public function create(Network $network)
    {
        return view("networks.create", [
            'network' => $network,
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

            $network = new Network($request->validated());

            if ($network->save()) {
                Session::flash('success', __('networks.created', ['name' => $network->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('networks.error', ['name' => $network->name, 'action' => 'crear']));
        }

        if ($network) {
            return redirect()->route('networks.show', $network->id);
        } else {
            return redirect()->route('networks.index');
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
        $network = Network::findOrFail($id);

        return view('networks.detail', [
            'network' => $network,
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
        $network = Network::findOrFail($id);

        return view("networks.edit", [
            'network' => $network,
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

            $network = Network::findOrFail($id);

            if ($network->update($request->validated())) {
                Session::flash('success', __('networks.updated', ['name' => $network->name]));
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('networks.error', ['name' => $network->name, 'action' => 'actualizar']));
        }

        if ($network->wasChanged('status')) {
            return redirect()->route('networks.index');
        }

        return redirect()->route('networks.show', $network->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $network = Network::findOrFail($id);

        try {
            $network->delete();
            Session::flash('success', __('networks.deleted', ['name' => $network->name]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', __('networks.error', ['name' => $network->name]));
        }

        return redirect()->route('networks.index');
    }
}
