<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Group all permissions by module (before first dot)
     */
    private function groupedPermissions()
    {
        $permissions = Permission::all()->pluck('name');
        $grouped = [];

        foreach ($permissions as $permission) {
            $module = explode('.', $permission)[0];
            if (!isset($grouped[$module])) {
                $grouped[$module] = [];
            }
            $grouped[$module][] = $permission;
        }

        ksort($grouped);
        foreach ($grouped as &$perms) {
            sort($perms);
        }

        return $grouped;
    }

    /**
     * Display all staff
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);

        return view('users.index', compact('users'));
    }


    /**
     * Show create staff form
     */
    public function create()
    {
        $roles = Role::all();
        $groupedPermissions = $this->groupedPermissions();

        return view('users.create', compact('roles', 'groupedPermissions'));
    }


    /**
     * Store new staff
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required|exists:roles,name',
        ]);


        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);


        // assign role
        $user->assignRole($request->role);

        // sync permissions directly on user
        $user->syncPermissions($request->permissions ?? []);


        return redirect()
            ->route('users.index')
            ->with('success','Staff created successfully');
    }


    /**
     * Show edit staff
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $groupedPermissions = $this->groupedPermissions();
        $userPermissions = $user->getDirectPermissions()->pluck('name')->toArray();

        return view('users.edit', compact('user', 'roles', 'groupedPermissions', 'userPermissions'));
    }



    /**
     * Update staff
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'role'=>'required'
        ]);


        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles([$request->role]);
        
        // sync permissions directly on user
        $user->syncPermissions($request->permissions ?? []);


        return redirect()
            ->route('users.index')
            ->with('success','Staff updated');
    }



    /**
     * Delete staff
     */
    public function destroy(User $user)
    {
        $user->delete();


        return redirect()
            ->route('users.index')
            ->with('success','Staff deleted');
    }
}