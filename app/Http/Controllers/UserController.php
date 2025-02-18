<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->name === 'Admin') {
            // Admin bisa lihat dan atur semua user
            $users = User::with(['role', 'manager'])->get();
            $managers = User::whereHas('role', function($q) {
                $q->where('name', 'Manager');
            })->get();
        } else {
            // Manager hanya bisa lihat user di bawahnya
            $users = User::where('manager_id', auth()->id())->with(['role', 'manager'])->get();
            $managers = collect([auth()->user()]); // Manager hanya bisa assign ke dirinya sendiri
        }

        $roles = Role::all();
        return view('users.index', compact('users', 'roles', 'managers'));
    }

    public function create()
    {
        if (auth()->user()->role->name === 'Admin') {
            // Admin bisa lihat role Manager dan User
            $roles = Role::whereIn('name', ['Manager', 'User'])->get();
            $managers = User::whereHas('role', function($q) {
                $q->where('name', 'Manager');
            })->get();
        } else {
            // Manager hanya bisa pilih role User
            $roles = Role::where('name', 'User')->get();
            $managers = collect([auth()->user()]);
        }

        return view('users.create', compact('roles', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'manager_id' => 'nullable|exists:users,id'
        ]);

    
        if (auth()->user()->role->name === 'Manager') {
            // Manager hanya bisa membuat user dengan role User
            $role = Role::find($request->role_id);
            if ($role->name !== 'User') {
                return back()->with('error', 'You can only create users with User role');
            }
            // Force manager_id ke ID manager yang login
            $request->merge(['manager_id' => auth()->id()]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'manager_id' => $request->manager_id
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function destroy(User $user)
    {
        // Cek apakah user yang akan dihapus berada di bawah manager yang sedang login
        if (auth()->user()->role->name === 'Manager' && $user->manager_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function edit(User $user)
    {
        // Cek apakah user yang akan diedit berada di bawah manager yang sedang login
        if (auth()->user()->role->name === 'Manager' && $user->manager_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if (auth()->user()->role->name === 'Admin') {
            $managers = User::whereHas('role', function($q) {
                $q->where('name', 'Manager');
            })->get();
        } else {
            $managers = collect([auth()->user()]);
        }

        $roles = Role::all();
        return view('users.edit', compact('user', 'roles', 'managers'));
    }

    public function update(Request $request, User $user)
    {
        // Cek apakah user yang akan diupdate berada di bawah manager yang sedang login
        if (auth()->user()->role->name === 'Manager' && $user->manager_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'manager_id' => 'nullable|exists:users,id'
        ]);

        // Jika yang login adalah manager, force manager_id ke ID mereka
        if (auth()->user()->role->name === 'Manager') {
            $request->merge(['manager_id' => auth()->id()]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = $request->role_id;
        $user->manager_id = $request->manager_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}