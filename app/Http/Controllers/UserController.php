<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

        return view('users.create', compact('roles'));
    }


    /**
     * Store new staff
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name',
        ]);


        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);


        // assign role
        $user->assignRole($request->role);


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

        return view('users.edit',compact('user','roles'));
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


        $user->syncRoles([$request->role]);


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