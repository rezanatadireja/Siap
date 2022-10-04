<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use \Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $data['roles'] = Role::all();
        $data['user'] = Auth::user();
        if ($request->ajax()) {
            $search = [];
            if (!empty($request->filter)) {
                $search = $request->filter;
                Session::put('user_filter', $search);
            } else if (Session::get('user_filter')) {
                $search = Session::get('user_filter');
            }
            $data['users'] = $this->user->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['users'] = $this->user->getAll('paginate');
        return view('users.index', $data);
    }

    public function create()
    {
        return view('users.edit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'username' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'role' => 'required'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $this->assignRoles($user, $request->role);
        $data['roles'] = Role::all();

        notify()->success("Success notification test", "Success", "topRight");
        
        return back();
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = Role::all();
        return view('users.forms-ubah', $data);
    }

    public function update(Request $request, $id)
    {
        if ($id == 1) {
            notify()->warning("Warning notification test", "Warning", "topRight");
            return back();
            // return $this->sendCommonResponse([], ['danger' => __('You cannot edit admin')]);
        } else if (auth()->user()->id == $id || auth()->user()->id == 1) {
            $rules = array(
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email,' . $id . '',
                'password' => 'nullable|min:4|max:30|confirmed',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Redirect::to('users/' . $id . '/edit')
                    ->withErrors($validator);
            } else {
                $user = User::find($id);
                $user->username = $request->username;
                $user->email = $request->email;
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                
                $this->assignRoles($user, $request->role);
                $data['roles'] = Role::all();
                $data['user'] = $user;
                notify()->success("Success notification test", "Success", "topRight");
                return redirect()-back();
            }
        }
    }

    public function destroy($id)
    {
        if ($id == 1) {;
            notify()->warning("Warning notification test", "Warning", "topRight");
            return back();
            // return $this->sendCommonResponse([], ['danger' => __('You cannot delete admin')]);
        } else {
            try {
                $users = User::find($id);
                $users->delete();
                notify()->success("Success notification test", "Success", "topRight");
                return back();
            } catch (\Illuminate\Database\QueryException $e) {
                return $this->sendCommonResponse([], ['danger' => __('Integrity constraint violation: You Cannot delete a parent row')]);
            }
        }
    }

    public function assignRoles($user, $role)
    {
        if ($user->id == 1) {
            Session::flash('message', 'You can not assign admin role');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $all_past_roles = $user->getRoleNames();

        foreach ($all_past_roles as $value) {
            $user->removeRole($value);
        }
        $user->assignRole($role);
    }

    public function roleCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Role::create(['name' => Str::slug($request->name)]);
        $data['roles'] = Role::all();
        notify()->success("Role Berhasil Di Simpan.", "Success", "topRight");
        return back();
    }

    public function permissionList($role_id = null)
    {
        $roles = Role::pluck('name', 'id');
        // data Permission Seeder
        $permissions = [];
        $perms = Permission::all();
        foreach ($perms as $key => $value) {
            $permission_set = '';
            $permission_name = explode(' ', $value->label);
            if ($key == 0) {
                $permission_set = $permission_name[1];
            }
            if (strtolower($permission_set) == strtolower($permission_name[1])) {
                $permissions[$permission_set][] = $value;
            } else {
                $permission_set = $permission_name[1];
                $permissions[$permission_set][] = $value;
            }
        }
        $role = Role::oldest()->first();
        if (!empty($role_id)) {
            $role = Role::findById($role_id);
        }
        $data = compact('perms', 'roles', 'role', 'role_id', 'permissions');
        if (request()->ajax()) {
            View::make('users.permissions', $data)->render();
            // return view('users.permission_list', $data)->render();
            // return response()->json(['data' => $data]);
        }
        return view('users.permissions', $data);
    }

    public function createPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
        ]);
        Permission::create(['label' => $request->label, 'name' => $request->name]);
        notify()->warning("Warning notification test", "Warning", "topRight");
        return back();
    }

    public function rolePermissionMapping(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'permissions' => 'required',
        ]);
        $role = Role::findById($request->role_id);
        if ($role->name == 'admin') {
            notify()->warning("Tidak Ada Akses Untuk Mengubah Ini!", "Warning", "topRight");
            return response()->json(['text' => 'Data Bisa Di Ubah.']);
        }
        $permissions = $request->permissions;

        // Delete all Previous Permissions
        $this->deleteAllPrevPermissions($role->id);
        $all_permissions = Permission::pluck('name', 'id');
        foreach ($permissions as $value) {
            // $permission = Permission::findById($value);
            $role->givePermissionTo($all_permissions[$value]);
        }
        return response()->json(['text' => 'Data Berhasil Di Simpan']);
    }

    public function deleteAllPrevPermissions($role_id)
    {
        DB::table('role_has_permissions')->where('role_id', $role_id)->delete();
    }

    private function sendCommonResponse($data = [], $notify = '', $option = null)
    {
        // $response = $this->processNotification($notify);
        if ($option == 'add') {
            $data['user'] = [];
            $response['replaceWith']['#addUser'] = view('users.forms', $data)->render();
        } else if ($option == 'update') {
            $response['replaceWith']['#editUser'] = view('users.forms-ubah', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showCustomer'] = view('customer.profile', $data)->render();
        } else if ($option == 'permission-list') {
            $response['replaceWith']['#permissionList'] = view('users.permission_list', $data)->render();
        }
        if ($option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete' || $option == 'role-create') {
            if (empty($data['users'])) {
                $data['users'] = $this->user->getAll('paginate');
            }
            if (empty($data['roles'])) {
                $data['roles'] = Role::all();
            }
            if (empty($data['user'])) {
                $data['user'] = Auth::user();
            }
            $response['replaceWith']['#usersTable'] = view('users.table', $data)->render();
            $response['replaceWith']['#addUser'] = view('users.forms', $data)->render();
        }
        // return $this->sendResponse($response);
    }
}
