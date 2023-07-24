<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
}
