<x-app-layout>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 animate-fade-in">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-6" style="color:#6b7280;">
        <a href="{{ route('buku.index') }}" class="hover:text-blue-600">Koleksi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span style="color:#1a1a2e;">Tambah Buku Baru</span>
    </nav>

    <div class="surface-card">
        <h1 class="text-xl font-bold mb-6" style="color:#1a1a2e;">Tambah Buku Baru</h1>

        @if($errors->any())
        <div class="alert alert-error mb-4">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="form-label">Judul Buku <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="form-input" placeholder="Masukkan judul lengkap buku">
                </div>

                <div>
                    <label class="form-label">Pengarang <span class="text-red-500">*</span></label>
                    <input type="text" name="author" value="{{ old('author') }}" required class="form-input" placeholder="Nama pengarang">
                </div>

                <div>
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="publisher" value="{{ old('publisher') }}" class="form-input" placeholder="Nama penerbit">
                </div>

                <div>
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" min="1900" max="{{ date('Y') }}" class="form-input">
                </div>

                <div>
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-input">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Stok Buku (Eksemplar) <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', 1) }}" min="0" required class="form-input">
                    <p class="text-xs text-gray-400 mt-1">Jumlah buku fisik yang tersedia di perpustakaan</p>
                </div>

                <div>
                    <label class="form-label">Lokasi / Rak Buku</label>
                    <select name="shelf_id" class="form-input">
                        <option value="">-- Pilih Rak --</option>
                        @foreach(\App\Models\Shelf::all() as $shelf)
                        <option value="{{ $shelf->id }}" {{ old('shelf_id') == $shelf->id ? 'selected' : '' }}>{{ $shelf->name }} {{ $shelf->location_code ? '('.$shelf->location_code.')' : '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Kode Barcode</label>
                    <input type="text" name="barcode" value="{{ old('barcode') }}" class="form-input" placeholder="Contoh: BK-001">
                </div>

                <div class="sm:col-span-2">
                    <label class="form-label">Sinopsis Buku</label>
                    <textarea name="synopsis" rows="4" class="form-input" placeholder="Tulis ringkasan cerita atau gambaran umum isi buku...">{{ old('synopsis') }}</textarea>
                </div>
            </div>

            <!-- File Upload -->
            <div class="border-t border-gray-100 pt-5">
                <h3 class="text-sm font-bold mb-4" style="color:#1a1a2e;">File Digital</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Upload File e-Book (PDF)</label>
                        <div class="border-2 border-dashed rounded-xl p-4 text-center hover:border-blue-400 transition-colors" style="border-color:#e5e7eb;">
                            <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-xs text-gray-400 mb-2">PDF hingga 50MB</p>
                            <input type="file" name="pdf_file" accept=".pdf" class="text-xs text-gray-600 w-full">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Upload Cover Buku (JPG/PNG)</label>
                        <div class="border-2 border-dashed rounded-xl p-4 text-center hover:border-blue-400 transition-colors" style="border-color:#e5e7eb;">
                            <svg class="w-8 h-8 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-xs text-gray-400 mb-2">Gambar cover buku</p>
                            <input type="file" name="cover_file" accept="image/*" class="text-xs text-gray-600 w-full">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-primary">Simpan Buku</button>
                <a href="{{ route('buku.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
