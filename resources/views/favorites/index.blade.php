<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-widest flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                Koleksi Favorit
            </h1>
            <p class="text-sm text-gray-500 font-bold uppercase tracking-widest mt-1">Buku yang anda simpan</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl text-sm font-medium" style="background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if($favorites->isEmpty())
        <div class="surface-card flex flex-col items-center justify-center p-12 text-center" style="min-height:400px;">
            <svg class="w-20 h-20 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
            <h2 class="text-xl font-black text-gray-400 uppercase tracking-widest mb-2 italic">Belum ada buku tersimpan</h2>
            <p class="text-sm text-gray-400 mb-6 font-bold">Jelajahi koleksi kami dan simpan buku yang menarik untuk dibaca nanti.</p>
            <a href="{{ route('buku.index') }}" class="btn-primary">Jelajahi Buku</a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 lg:gap-6">
            @foreach($favorites as $favorite)
                @php $book = $favorite->book; @endphp
                <div class="surface-card flex flex-col h-full overflow-hidden p-0 relative group">
                    {{-- Remove Favorite Form --}}
                    <form action="{{ route('buku.favorite', $book->id) }}" method="POST" class="absolute top-2 right-2 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf
                        <button type="submit" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur shadow hover:bg-red-50 hover:text-red-600 text-gray-600 flex items-center justify-center transition-colors" title="Hapus dari Favorit">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                    </form>

                    <a href="{{ route('buku.show', $book->id) }}" class="block shrink-0 relative overflow-hidden bg-gray-100" style="aspect-ratio:3/4;">
                        @if($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-600 text-white font-black text-4xl">
                                {{ substr($book->title, 0, 1) }}
                            </div>
                        @endif
                        
                        @if($book->file_path)
                            <div class="absolute top-2 left-2 bg-blue-600 text-white text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded-sm shadow-md">
                                e-Book
                            </div>
                        @endif
                    </a>

                    <div class="p-3 flex-1 flex flex-col">
                        <P class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1">{{ $book->category->name ?? 'Kategori' }}</P>
                        <a href="{{ route('buku.show', $book->id) }}" class="text-xs font-black text-gray-900 leading-tight line-clamp-2 hover:text-blue-600 transition-colors italic mb-2">
                            {{ $book->title }}
                        </a>
                        
                        <div class="mt-auto pt-2 border-t border-gray-50 flex items-center justify-between">
                            @if($book->file_path)
                                <a href="{{ route('buku.read', $book->id) }}" class="text-[10px] font-black text-blue-600 hover:text-blue-700 uppercase tracking-widest flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                    Baca Sekarang 
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @elseif($book->stock > 0)
                                <span class="text-[9px] font-bold text-green-600 px-2 py-0.5 bg-green-50 rounded-sm">Tersedia {{ $book->stock }}</span>
                            @else
                                <span class="text-[9px] font-bold text-red-600 px-2 py-0.5 bg-red-50 rounded-sm">Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $favorites->links() }}
        </div>
    @endif
</div>
</x-app-layout>
