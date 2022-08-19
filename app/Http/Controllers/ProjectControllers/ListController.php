<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Requests\UpdateListRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateListRequest;
use App\PList;
use Illuminate\Support\Facades\Lang;

class ListController extends Controller
{
    /**
     * @param Request $request
     * @param PList|null $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ?PList $list = null)
    {
        if ($request->has('q')) {
            $search = $request->get('q', []);
        } else {
            $search = get_last_user_search('lists', []);
        }

        set_last_user_search('lists', $search);

        $per_page = module_per_page('lists', 20);
        $lists_options = validatePermission(['edit_lists', 'all_lists']) ? PList::search($search)->paginate($per_page) : PList::search($search)->status()->paginate($per_page);
        $lists_options->appends('per_page', $per_page);

        return view("lists.index", [
            "lists" => config('lists.lists', []),
            "lists_options" => $lists_options,
            "list" => $list,
            'search' => $search,
            'protected' => config('lists.protected', [])
        ]);
    }

    /**
     * @param PList $list
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(PList $list, Request $request)
    {
        return $this->index($request, $list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateListRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateListRequest $request)
    {
        $option = new PList(['status' => 1] + $request->validated());

        if ($option->save()) {
            Session::flash('success', __('lists.created', ['name' => $option->option]));
        } else {
            Session::flash('error', __('lists.created', ['name' => $option->option]));
        }

        return redirect()->route('lists.index');
    }

    /**
     * @param int $id
     * @param UpdateListRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, UpdateListRequest $request)
    {
        $option = PList::findOrFail($id);
        $option->fill($request->validated());
        
        if ($option->save()) {
            Session::flash('success', __('lists.updated', ['name' => $option->option]));
        } else {
            Session::flash('error', __('lists.updated', ['name' => $option->option]));
        }

        return redirect()->route('lists.index');
    }
}
