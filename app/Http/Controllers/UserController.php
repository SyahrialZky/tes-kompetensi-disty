<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = ['petugas', 'admin'];  // List role yang tersedia
        return view('users.create', compact('roles'));
    }
    // Store a newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|',
            'role' => 'required|in:petugas,admin'  // Validate role is either 'petugas' or 'admin'
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
    }
    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $roles = ['petugas', 'admin'];
        return view('users.edit', compact('user', 'roles'));
    }

    // Update the specified user in the database
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|',
            'role' => 'required|in:petugas,admin'  // Ensure role is valid
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diubah.');
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    // Update the role of the specified user
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:petugas,admin'  // Ensure the role is valid
        ]);

        // Update the role of the user
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Role user berhasil diubah.');
    }
}
