<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{

    public function login()
    {
        return view('backend.admin.auth.login');
    }

    public function passwordRequest()
    {
        return view('backend.admin.auth.forgot-password');
    }

    public function passwordReset(Request $request)
    {
        return view('backend.admin.auth.reset-password', ['request' => $request]);
    }

    public function passwordConfirm()
    {
        return view('backend.admin.auth.confirm-password');
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
