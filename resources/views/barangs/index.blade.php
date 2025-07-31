<x-app-layout>
    <div class="max-w-5xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-green-100/80 rounded-xl shadow-2xl p-8 border border-green-100 dark:border-green-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <h1 class="text-2xl font-bold text-green-700 dark:text-green-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                    Manajemen Stok Opname
                </h1>
                <a href="{{ route('barangs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    Tambah Barang
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-green-100 dark:divide-green-200 text-sm">
                    <thead class="bg-green-50 dark:bg-green-200/80">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Kode</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Stok</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Stok Minimum</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Status</th>
                            <th class="px-4 py-3 text-center font-semibold text-green-800 dark:text-green-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/80 dark:bg-green-50/60 divide-y divide-green-50 dark:divide-green-100">
                        @foreach($barangs as $barang)
                        <tr class="hover:bg-green-100 dark:hover:bg-green-200 transition @if($barang->stok <= $barang->stok_minimum) bg-red-50 dark:bg-red-200 @endif">
                            <td class="px-4 py-3">{{ $barang->nama }}</td>
                            <td class="px-4 py-3">{{ $barang->kode }}</td>
                            <td class="px-4 py-3">{{ $barang->stok }}</td>
                            <td class="px-4 py-3">{{ $barang->stok_minimum }}</td>
                            <td class="px-4 py-3">
                                @if($barang->stok <= $barang->stok_minimum)
                                    <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 text-xs font-bold animate-pulse">Stok Minimum!</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 text-xs font-bold">Aman</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center flex flex-col sm:flex-row gap-2 justify-center">
                                <a href="{{ route('barangs.edit', $barang) }}" class="inline-flex items-center gap-1 px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white font-semibold shadow transition">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
