<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-4xl font-black italic tracking-tighter text-gray-900 uppercase leading-none">
                    Pengaturan <br>
                    <span class="text-blue-600">Perpustakaan</span>
                </h1>
                <p class="text-md font-bold text-gray-400 mt-4 uppercase tracking-widest">Konfigurasi sistem digital SMPN 18 Surabaya</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 p-8 sm:p-12">
                <form method="POST" action="{{ route('pengaturan.update') }}" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-6 border-b border-gray-50 pb-8">
                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 space-y-4">
                                <div>
                                    <h3 class="text-lg font-black italic uppercase tracking-tight text-gray-900">Durasi Peminjaman</h3>
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-1">Berapa hari siswa boleh meminjam e-book sebelum telat?</p>
                                </div>
                                <div class="relative max-w-xs">
                                    <input 
                                        type="number" 
                                        name="loan_duration" 
                                        id="loan_duration" 
                                        value="{{ $loanDuration }}"
                                        min="1"
                                        max="365"
                                        required
                                        class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-xl font-black text-gray-900 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm"
                                    >
                                    <div class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 font-black italic uppercase tracking-widest text-xs">
                                        Hari
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Minimal 1 Hari • Maksimal 365 Hari</span>
                        </div>
                        <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-black italic uppercase tracking-widest px-8 py-4 rounded-2xl shadow-xl shadow-blue-200 transition-all hover:scale-105 active:scale-95">
                            Simpan Perubahan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
