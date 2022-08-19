<?php

namespace App\Http\Controllers\ProjectControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdateUserRequest;
use App\RoleBase;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $search = $request->has('q') ? $request->get('q') ?? [] : get_last_user_search('users', []);
        set_last_user_search('users', $search);

        $roles = Role::orderBy('name')->get();

        $per_page = module_per_page('users', 20);
        $users = User::search($search)->paginate($per_page);
        $users->appends($search + ['per_page' => $per_page]);

        return view('users.index', [
            'users' => $users,
            'search' => $search,
            'roles' => $roles,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get(['id', 'name'])->except(1);

        return view('users.create', [
            'user' => new User(),
            'roles' => $roles
        ]);
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $user = new User($request->validated());

            if ($user->save()) {
                $this->saveRoles($user, $request->get('role', []));
                Session::flash('success', __('users.created', ['name' => $user->full_name]));
            } else {
                Session::flash('error', __('users.error', ['name' => $user->full_name, 'action' => 'creado']));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('users.error', ['name' => $user->full_name, 'action' => 'creado']));
        }

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.detail', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get(['id', 'name'])->except(1);

        return view("users.edit", [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        try {
            if ($user->update($request->validated())) {
                $this->saveRoles($user, $request->get('role', $user->roles()->get()->pluck('id')->toArray() ?? []));
                Session::flash('success', __('users.updated', ['name' => $user->full_name]));
            } else {
                Session::flash('error', __('users.error', ['name' => $user->full_name, 'action' => 'actualizado']));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', __('users.error', ['name' => $user->full_name, 'action' => 'actualizado']));
        }

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            if ($user->parentModule ?? null) {
                $user->parentModule->delete();
            }

            $user->delete();
            Session::flash('success', __('users.deleted', ['name' => $user->full_name]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', __('users.failed', ['name' => $user->full_name]));
        }

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @param array $roles
     */
    private function saveRoles(User $user, array $roles = [])
    {
        $user->syncRoles($user->is_admin ? RoleBase::ADMIN : $roles);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function changePassword(User $user)
    {
        return view("users.change_password")->with("user", $user);
    }

    /**
     * @param User $user
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePassword(User $user, ChangePasswordRequest $request)
    {
        if ($user->update(['password' => $request->get("password")])) {
            Session::flash('success', __('users.updated', ['name' => $user->name]));
        }

        return redirect()->route('users.index');
    }
}
