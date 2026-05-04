<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        if ($request->has('role_name')) {
            $request->validate(['role_name' => 'required|unique:roles,name']);
            Role::create(['name' => $request->role_name]);
            return redirect()->back()->with('success', 'Peran berhasil ditambahkan.');
        }

        if ($request->has('permission_name')) {
            $request->validate(['permission_name' => 'required|unique:permissions,name']);
            Permission::create(['name' => $request->permission_name]);
            return redirect()->back()->with('success', 'Izin berhasil ditambahkan.');
        }

        return redirect()->back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'Peran dihapus.');
    }
}
