<x-app-layout>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="mb-8">
        <a href="{{ route('rak.index') }}" class="text-xs font-bold text-gray-400 hover:text-gray-900 uppercase tracking-widest no-underline">← Kembali</a>
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight mt-3">Edit Rak: {{ $rak->name }}</h2>
    </div>
    <div class="surface-card">
        <form action="{{ route('rak.update', $rak->id) }}" method="POST" class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Rak *</label>
                <input type="text" name="name" value="{{ old('name', $rak->name) }}" required class="w-full rounded-xl border-gray-200 bg-gray-50 focus:ring-primary font-bold text-sm h-12 px-4">
                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kode Lokasi</label>
                <input type="text" name="location_code" value="{{ old('location_code', $rak->location_code) }}" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:ring-primary font-bold text-sm h-12 px-4">
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:ring-primary text-sm px-4 py-3">{{ old('description', $rak->description) }}</textarea>
            </div>
            <button type="submit" class="btn-primary w-full">Perbarui Rak</button>
        </form>
    </div>
</div>
</x-app-layout>
