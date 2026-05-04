<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pinjam Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-4">
                        @csrf
                        @if(auth()->user()->isAdmin())
                        <div>
                            <x-input-label for="user_id" value="Pilih Siswa (Peminjam)" />
                            <select id="user_id" name="user_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled selected>Pilih Siswa...</option>
                                @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->kelas }})</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
                        </div>
                        @endif

                        <div>
                            <x-input-label for="book_id" value="Pilih Buku" />
                            <select id="book_id" name="book_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled selected>Pilih Buku...</option>
                                @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('book_id')" />
                        </div>
                        
                        <div class="flex justify-end pt-4 space-x-2">
                            <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">Batal</a>
                            <x-primary-button>Proses Pinjam</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
