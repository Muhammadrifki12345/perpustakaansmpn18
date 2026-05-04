<x-app-layout>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="mb-8">
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Kelola Roles & Permissions 🎭</h2>
        <p class="text-sm text-gray-500 mt-1">Atur peran dan izin pengguna sistem.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Add Role --}}
        <div class="surface-card">
            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Tambah Role Baru</h3>
            <form action="{{ route('roles.store') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="role_name" placeholder="Nama role..." required class="flex-1 rounded-xl border-gray-200 bg-gray-50 focus:ring-primary text-sm h-12 px-4 font-bold">
                <button type="submit" class="btn-primary btn-sm shrink-0">Tambah</button>
            </form>
            <div class="mt-6 space-y-2">
                @foreach($roles ?? [] as $role)
                <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-black text-xs">{{ strtoupper(substr($role->name, 0, 2)) }}</div>
                        <span class="text-sm font-bold text-gray-800">{{ $role->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Hapus role ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 text-xs font-bold hover:underline">Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Add Permission --}}
        <div class="surface-card">
            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Tambah Permission Baru</h3>
            <form action="{{ route('roles.store') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="permission_name" placeholder="Nama permission..." required class="flex-1 rounded-xl border-gray-200 bg-gray-50 focus:ring-primary text-sm h-12 px-4 font-bold">
                <button type="submit" class="btn-primary btn-sm shrink-0">Tambah</button>
            </form>
            <div class="mt-6 space-y-2">
                @foreach($permissions ?? [] as $perm)
                <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 border border-gray-100">
                    <span class="text-sm font-bold text-gray-800">{{ $perm->name }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Assign Role --}}
    <div class="mt-8">
        <a href="{{ route('roles.assign') }}" class="btn-outline no-underline inline-flex">Tugaskan Role ke User →</a>
    </div>
</div>
</x-app-layout>
