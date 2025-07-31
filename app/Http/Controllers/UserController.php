<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return View::make('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return View::make('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        $user->assignRole($validated['role']);
        return Redirect::route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRole = $user->roles()->pluck('name')->first();
        return View::make('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->getKey(),
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }
        $user->update($updateData);
        $user->syncRoles([$validated['role']]);
        return Redirect::route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('users.index')->with('success', 'User deleted successfully.');
    }
}
