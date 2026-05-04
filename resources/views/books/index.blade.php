<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 animate-fade-in">

    {{-- Page Header (Bersih & Formal) --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-gray-900 uppercase">
                Katalog Buku 📚
            </h1>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">
                Temukan koleksi buku terbaik untuk menunjang belajarmu.
            </p>
        </div>
        @if(auth()->user()->isAdmin())
        <a href="{{ route('buku.create') }}" class="flex items-center gap-2 px-6 py-3 bg-[#4F7DF3] text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 no-underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Buku Baru
        </a>
        @endif
    </div>

    {{-- Search Console (Formal) --}}
    <div class="bg-white p-4 rounded-[2rem] border border-gray-100 shadow-sm mb-12">
        <form action="{{ route('buku.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Judul atau Penulis..." 
                       class="w-full pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-[#4F7DF3]/20 focus:bg-white transition-all">
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto">
                <select name="category" class="flex-1 md:w-48 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-600 focus:ring-2 focus:ring-[#4F7DF3]/20 cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                
                <button type="submit" class="px-8 py-4 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-black transition-all">
                    Cari
                </button>

                @if(request()->anyFilled(['search', 'category']))
                    <a href="{{ route('buku.index') }}" class="p-4 bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-red-600 rounded-2xl transition-all" title="Reset Filter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Book Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($books as $book)
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
                {{-- Link Detail (Cover) --}}
                <a href="{{ route('buku.show', $book->id) }}" class="block no-underline">
                    <div class="aspect-[3/4] overflow-hidden relative m-3 rounded-[1.5rem] bg-gray-50 border border-gray-50">
                        @if($book->cover_image && !str_starts_with($book->cover_image,'http'))
                            <img src="{{ asset($book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @elseif($book->cover_image)
                            <img src="{{ $book->cover_image }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-200 font-black text-4xl uppercase">{{ substr($book->title, 0, 1) }}</div>
                        @endif
                        
                        {{-- Category Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-[8px] font-black uppercase tracking-widest text-gray-900 rounded-lg shadow-sm border border-gray-100">
                                {{ $book->category->name ?? 'UMUM' }}
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Book Info --}}
                <div class="p-5 pt-2 text-center">
                    <a href="{{ route('buku.show', $book->id) }}" class="no-underline group-hover:text-[#4F7DF3] transition-colors">
                        <h3 class="text-sm font-black text-gray-900 line-clamp-1 uppercase italic tracking-tight">{{ $book->title }}</h3>
                    </a>
                    <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">{{ $book->author }}</p>
                    
                    <div class="flex items-center justify-center gap-3 mt-3 mb-4">
                        <div class="text-[9px] font-black uppercase text-gray-400 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full {{ $book->stock > 0 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            Stok: <span class="{{ $book->stock > 0 ? 'text-gray-900' : 'text-red-500' }} font-bold">{{ $book->stock }}</span>
                        </div>
                        <div class="w-1 h-1 bg-gray-200 rounded-full"></div>
                        <div class="text-[9px] font-black uppercase text-gray-400">
                            📖 <span class="text-gray-900 font-bold">{{ $book->borrow_count ?? 0 }}x</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-2">
                        @if(auth()->user()->isAdmin())
                            <div class="flex gap-2">
                                <a href="{{ route('buku.edit', $book->id) }}" class="flex-1 py-2.5 bg-gray-900 text-white rounded-xl font-black text-[9px] uppercase tracking-widest no-underline hover:bg-black transition-all">EDIT</a>
                                <form action="{{ route('buku.destroy', $book->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full py-2.5 bg-red-600 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-red-700 transition-all">HAPUS</button>
                                </form>
                            </div>
                        @else
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('peminjaman.store') }}" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="w-full py-2.5 {{ $book->stock > 0 ? 'bg-[#4F7DF3]' : 'bg-amber-500' }} text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:brightness-110 transition-all shadow-md shadow-blue-100 flex flex-col items-center justify-center leading-none">
                                        @if($book->stock > 0)
                                            <span>PINJAM FISIK</span>
                                        @else
                                            <span class="mb-0.5">DAFTAR TUNGGU</span>
                                            <span class="text-[7px] opacity-75 font-medium">Menunggu: {{ $book->waitlists()->where('status', 'waiting')->count() }} orang</span>
                                        @endif
                                    </button>
                                </form>
                                @if($book->file_path)
                                    <a href="{{ route('buku.read', $book->id) }}" class="flex-1 py-2.5 border-2 border-[#4F7DF3] text-[#4F7DF3] rounded-xl font-black text-[9px] uppercase tracking-widest no-underline text-center hover:bg-blue-50 transition-all flex items-center justify-center">
                                        BACA DIGITAL
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-gray-100">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-300 uppercase italic tracking-tighter">Buku tidak ditemukan</h3>
                <p class="text-gray-400 mt-2 font-medium">Coba gunakan kata kunci atau kategori yang lain.</p>
            </div>
        @endforelse
    </div>
</div>
</x-app-layout>
