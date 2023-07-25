<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function AssignRolePermission() {
        $permissions = Permission::all();
        $roles = Role::all();
        $permission_groups = User::getPermissionsGroup();
        return view('backend.admin.assign_role_permission.index', compact('permissions', 'roles', 'permission_groups'));
    }

    public function AssignRolePermissionStore(Request $request) {
        $data = array();
        $permissions = $request->permission_id;
        foreach($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        return back();
    }

    public function EditRolePermission($id) {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $permission_groups = User::getPermissionsGroup();
        return view('backend.admin.assign_role_permission.edit', compact('permissions', 'role', 'permission_groups'));
    }

    public function UpdateRolePermission(Request $request, $id) {
        $role = Role::findOrFail($id);
        $permissions = $request->permission_id;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return back();
    }

    public function AllAdmin() {
        $allAdmin = User::where('role', 'Admin')->get();
        $allRole = Role::all();
        return view('backend.admin.all_admin.index', compact('allAdmin', 'allRole'));
    }

    public function AdminStore(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Admin',
        ]);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return back();
    }

    public function AdminEdit($id) {
        $admin = User::findOrFail($id);
        $allRole = Role::all();
        return view('backend.admin.all_admin.edit', compact('admin', 'allRole'));
    }

    public function AdminUpdate(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'roles' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'Admin';
        $user->save();

        $user->roles()->detach();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('all.admin');
    }
}
