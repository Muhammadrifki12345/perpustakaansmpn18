<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 animate-fade-in">

    {{-- Page Header (Bersih & Formal) --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-gray-900 uppercase">
                @if(Auth::user()->isAdmin()) Manajemen Peminjaman 📑 @else Riwayat Peminjaman 📑 @endif
            </h1>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">
                {{ $loans->count() }} transaksi peminjaman tercatat dalam sistem.
            </p>
        </div>
        @if(!Auth::user()->isAdmin())
        <a href="{{ route('buku.index') }}" class="flex items-center gap-2 px-6 py-3 bg-[#4F7DF3] text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 no-underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Pinjam Buku Baru
        </a>
        @endif
    </div>

    {{-- Tabs Filter (Tegas & Formal) --}}
    <div class="flex items-center gap-8 mb-8 border-b border-gray-200">
        <a href="{{ route('peminjaman.index') }}" class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ !request('status') ? 'text-[#1E3A8A] border-b-4 border-[#1E3A8A]' : 'text-[#9CA3AF] hover:text-gray-600' }} no-underline">Semua</a>
        <a href="{{ route('peminjaman.index', ['status' => 'active']) }}" class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ request('status') === 'active' ? 'text-[#1E3A8A] border-b-4 border-[#1E3A8A]' : 'text-[#9CA3AF] hover:text-gray-600' }} no-underline">Buku Dipinjam</a>
        <a href="{{ route('peminjaman.index', ['status' => 'returned']) }}" class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ request('status') === 'returned' ? 'text-[#1E3A8A] border-b-4 border-[#1E3A8A]' : 'text-[#9CA3AF] hover:text-gray-600' }} no-underline">Sudah Kembali</a>
    </div>

    {{-- Content List --}}
    <div class="space-y-4">
        @forelse($loans as $loan)
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center gap-6">
                {{-- Cover Kecil --}}
                <div class="w-16 h-20 rounded-lg overflow-hidden shrink-0 shadow-sm border border-gray-50">
                    @if($loan->book->cover_image && !str_starts_with($loan->book->cover_image,'http'))
                        <img src="{{ asset($loan->book->cover_image) }}" class="w-full h-full object-cover">
                    @elseif($loan->book->cover_image)
                        <img src="{{ $loan->book->cover_image }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-50 flex items-center justify-center text-gray-300 text-sm font-bold uppercase">{{ substr($loan->book->title,0,1) }}</div>
                    @endif
                </div>

                {{-- Book Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-base font-black text-gray-900 line-clamp-1 uppercase italic tracking-tight">{{ $loan->book->title }}</h3>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $loan->book->author }}</p>
                            @if(Auth::user()->isAdmin())
                            <p class="text-[10px] text-gray-500 mt-1 font-bold">
                                PEMINJAM: <span class="text-[#4F7DF3]">{{ $loan->user->name }}</span>
                            </p>
                            @endif
                        </div>
                        <div class="shrink-0">
                            @if($loan->status === 'returned')
                                <span class="px-3 py-1.5 bg-green-50 text-green-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-green-100">Dikembalikan</span>
                            @elseif($loan->status === 'pending')
                                <span class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-amber-100 italic animate-pulse">Menunggu ACC</span>
                            @elseif($loan->status === 'rejected')
                                <span class="px-3 py-1.5 bg-red-50 text-red-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-red-100">Ditolak</span>
                            @else
                                <span class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-blue-100">Dipinjam</span>
                            @endif
                        </div>
                    </div>

                    {{-- Details & Actions --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 mt-4 pt-3 border-t border-gray-50">
                        <div class="flex items-center gap-6 text-[10px] font-bold text-gray-400 uppercase">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                PINJAM: <span class="text-gray-700">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</span>
                            </div>
                            @if($loan->expected_return_date)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                BATAS: <span class="{{ $loan->status !== 'returned' && \Carbon\Carbon::parse($loan->expected_return_date)->isPast() ? 'text-red-500' : 'text-gray-700' }}">{{ \Carbon\Carbon::parse($loan->expected_return_date)->format('d M Y') }}</span>
                            </div>
                            @endif
                            @if($loan->actual_return_date)
                            <div class="flex items-center gap-1.5 text-green-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                KEMBALI: <span>{{ \Carbon\Carbon::parse($loan->actual_return_date)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            @if($loan->invoice_number)
                            <a href="{{ route('peminjaman.invoice', $loan->id) }}" class="flex items-center gap-2 px-4 py-2 border-2 border-gray-900 text-gray-900 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-gray-900 hover:text-white transition-all no-underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Invoice
                            </a>
                            @endif
                            @if($loan->status === 'borrowed' && Auth::user()->isAdmin())
                            <form action="{{ route('peminjaman.update', $loan->id) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="returned">
                                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-green-700 transition-all shadow-lg shadow-green-100">Kembalikan</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-16 rounded-[2.5rem] border border-gray-100 text-center shadow-sm">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-300 uppercase tracking-tighter">Belum ada riwayat peminjaman</h3>
            <a href="{{ route('buku.index') }}" class="btn-primary inline-flex mt-6 no-underline bg-[#4F7DF3]">Jelajahi Katalog</a>
        </div>
        @endforelse
    </div>
</div>
</x-app-layout>
