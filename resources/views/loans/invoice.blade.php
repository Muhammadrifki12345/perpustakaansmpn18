<x-app-layout>
<div class="max-w-4xl mx-auto px-4 py-10 animate-fade-in">

    {{-- Back button --}}
    <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 mb-8 hover:text-primary no-underline uppercase tracking-widest">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    {{-- Invoice Card --}}
    <div id="invoice-area" class="bg-white rounded-[2.5rem] shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="relative px-10 pt-10 pb-8" style="background: linear-gradient(135deg, #000080 0%, #1e1e9c 100%);">
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-white/60 uppercase tracking-[0.2em]">E-Pustaka SMPN 18 Surabaya</p>
                            <h1 class="text-xl font-black text-white uppercase tracking-tight">Bukti Peminjaman</h1>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-white/50 uppercase tracking-widest mb-1">No. Invoice</p>
                    <p class="text-lg font-black text-white tracking-wider">{{ $loan->invoice_number ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Status Badge --}}
            <div class="mt-4">
                @if($loan->status === 'pending')
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-amber-400/20 backdrop-blur-md text-amber-200 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-400/30">
                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span> Menunggu Persetujuan
                    </span>
                @elseif($loan->status === 'borrowed')
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-400/20 backdrop-blur-md text-emerald-200 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-400/30">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full"></span> Sedang Dipinjam
                    </span>
                @elseif($loan->status === 'returned')
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-400/20 backdrop-blur-md text-blue-200 rounded-full text-[10px] font-black uppercase tracking-widest border border-blue-400/30">
                        <span class="w-2 h-2 bg-blue-400 rounded-full"></span> Sudah Dikembalikan
                    </span>
                @elseif($loan->status === 'rejected')
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-400/20 backdrop-blur-md text-red-200 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-400/30">
                        <span class="w-2 h-2 bg-red-400 rounded-full"></span> Ditolak
                    </span>
                @endif
            </div>

            {{-- Decorative --}}
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        {{-- Body --}}
        <div class="px-10 py-8 space-y-8">

            {{-- Book & Borrower Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Peminjam --}}
                <div>
                    <h3 class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4">Data Peminjam</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center font-black text-primary">
                                {{ substr($loan->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-gray-900">{{ $loan->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $loan->user->email }}</p>
                            </div>
                        </div>
                        @if($loan->user->kelas)
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Kelas: {{ $loan->user->kelas }}
                        </div>
                        @endif
                        @if($loan->user->phone)
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $loan->user->phone }}
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Buku --}}
                <div>
                    <h3 class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4">Data Buku</h3>
                    <div class="flex items-start gap-4">
                        <div class="w-16 h-24 rounded-xl overflow-hidden bg-gray-100 shrink-0 shadow-md">
                            @if($loan->book->cover_image)
                                <img src="{{ asset($loan->book->cover_image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 font-black text-2xl">
                                    {{ substr($loan->book->title, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-black text-gray-900 leading-tight">{{ $loan->book->title }}</p>
                            <p class="text-xs text-gray-400">{{ $loan->book->author }}</p>
                            @if($loan->book->publisher)
                                <p class="text-xs text-gray-400">Penerbit: {{ $loan->book->publisher }}</p>
                            @endif
                            @if($loan->book->category)
                                <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-600 rounded text-[10px] font-bold">{{ $loan->book->category->name }}</span>
                            @endif
                            @if($loan->book->shelf)
                                <p class="text-[10px] text-gray-400 mt-1">📍 Lokasi: {{ $loan->book->shelf->name }} {{ $loan->book->shelf->location_code ? '('.$loan->book->shelf->location_code.')' : '' }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="border-t border-dashed border-gray-200"></div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-1">Tanggal Pinjam</p>
                    <p class="text-sm font-black text-gray-900">{{ $loan->loan_date ? $loan->loan_date->format('d M Y') : '-' }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-1">Batas Kembali</p>
                    <p class="text-sm font-black text-gray-900">{{ $loan->expected_return_date ? $loan->expected_return_date->format('d M Y') : '-' }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-1">Tgl. Kembali</p>
                    <p class="text-sm font-black text-gray-900">{{ $loan->actual_return_date ? $loan->actual_return_date->format('d M Y') : '-' }}</p>
                </div>
                <div class="p-4 rounded-2xl border text-center {{ $loan->is_late ? 'bg-red-50 border-red-100' : 'bg-gray-50 border-gray-100' }}">
                    <p class="text-[9px] font-black {{ $loan->is_late ? 'text-red-400' : 'text-gray-300' }} uppercase tracking-widest mb-1">Status Waktu</p>
                    <p class="text-sm font-black {{ $loan->is_late ? 'text-red-600' : 'text-emerald-600' }}">
                        {{ $loan->is_late ? 'Terlambat' : 'Tepat Waktu' }}
                    </p>
                </div>
            </div>

            {{-- Catatan Teguran --}}
            @if($loan->notes)
            <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    <div>
                        <p class="text-[10px] font-black text-amber-700 uppercase tracking-widest mb-1">Catatan Pengurus</p>
                        <p class="text-sm text-amber-800">{{ $loan->notes }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Kebijakan --}}
            <div class="p-5 bg-blue-50/50 rounded-2xl border border-blue-100/50">
                <h4 class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-2">Informasi Penting</h4>
                <ul class="space-y-1.5 text-xs text-blue-600/80">
                    <li class="flex items-start gap-2">
                        <span class="text-blue-400">•</span>
                        Tunjukkan bukti peminjaman ini saat mengambil dan mengembalikan buku di perpustakaan.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-400">•</span>
                        Pengambilan dan pengembalian buku dilakukan langsung di perpustakaan sekolah.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-400">•</span>
                        Tidak ada denda keterlambatan, namun siswa diharapkan mengembalikan tepat waktu.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-blue-400">•</span>
                        Jaga buku dengan baik. Kerusakan atau kehilangan akan dicatat oleh pengurus.
                    </li>
                </ul>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-10 py-6 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
            <p class="text-[10px] text-gray-400 font-bold">
                Dicetak pada: {{ now()->format('d M Y, H:i') }} WIB
            </p>
            <button onclick="window.print()" class="btn-primary btn-sm no-print">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Invoice
            </button>
        </div>
    </div>
</div>

{{-- Print Styles --}}
<style>
    @media print {
        .epustaka-nav, .no-print, .alert { display: none !important; }
        body { background: white !important; }
        #invoice-area { box-shadow: none !important; border-radius: 0 !important; border: 1px solid #e5e7eb !important; }
    }
</style>
</x-app-layout>
