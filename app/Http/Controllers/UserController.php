<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $query = \App\Models\User::query();

        if (!auth()->user()->isSuperAdmin()) {
            $query->where('role', 'siswa');
        } else {
            if ($request->has('role')) {
                $query->where('role', $request->role);
            }
        }

        if ($request->get('filter') === 'pending') {
            $query->where('is_approved', false);
        } else {
            $query->where('is_approved', true);
        }

        $users = $query->withCount(['loans', 'activities'])
            ->latest()
            ->paginate(5)
            ->through(function($user) {
                // Determine active status: has borrowed in last 30 days
                $lastLoan = $user->loans()->latest()->first();
                $user->is_active = $lastLoan && $lastLoan->created_at->gt(now()->subDays(30));
                return $user;
            });

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'kelas'    => 'nullable|string|max:50',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['role'] = auth()->user()->isSuperAdmin() ? ($request->role ?? 'siswa') : 'siswa';
        $validated['is_approved'] = true; // Admin created users are auto-approved
        $validated['password'] = bcrypt($validated['password']);

        \App\Models\User::create($validated);

        return redirect()->route('pengguna.index')->with('success', 'Anggota siswa berhasil ditambahkan dan diaktifkan.');
    }

    public function edit(\App\Models\User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        // Librarian cannot edit admins/superadmins
        if (!auth()->user()->isSuperAdmin() && $user->isAdmin()) {
            abort(403);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if (!auth()->user()->isSuperAdmin() && $user->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'kelas'    => 'nullable|string|max:50',
            'phone'    => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        if (auth()->user()->isSuperAdmin() && $request->has('role')) {
            $validated['role'] = $request->role;
        }

        $user->update($validated);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function approve(\App\Models\User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $user->update(['is_approved' => true]);

        return back()->with('success', "Akun {$user->name} telah berhasil di-ACC (disetujui)!");
    }

    public function destroy(\App\Models\User $user)
    {
        if (!auth()->user()->isAdmin()) {
            return back()->with('error', 'Akses ditolak.');
        }

        if (!auth()->user()->isSuperAdmin() && $user->isAdmin()) {
            return back()->with('error', 'Akses ditolak. Hanya Super Admin yang dapat menghapus akun pengurus.');
        }

        $user->delete();
        return back()->with('success', 'Akun siswa berhasil dihapus.');
    }
}
