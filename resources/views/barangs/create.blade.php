<x-app-layout>
<div class="max-w-xl mx-auto mt-8">
    <div class="bg-white/90 dark:bg-green-100/80 rounded-xl shadow-2xl p-4 sm:p-8 border border-green-100 dark:border-green-200">
        <h1 class="text-2xl font-bold text-green-700 dark:text-green-800 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Barang
        </h1>
        <form action="{{ route('barangs.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block mb-1 font-semibold text-green-800 dark:text-green-900">Nama Barang</label>
                <input type="text" name="nama" class="w-full px-4 py-2 rounded-lg border border-green-200 dark:border-green-200 bg-green-50 dark:bg-green-50 focus:ring-2 focus:ring-green-400 focus:outline-none transition" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-green-800 dark:text-green-900">Kode Barang</label>
                <input type="text" name="kode" class="w-full px-4 py-2 rounded-lg border border-green-200 dark:border-green-200 bg-green-50 dark:bg-green-50 focus:ring-2 focus:ring-green-400 focus:outline-none transition" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-green-800 dark:text-green-900">Stok</label>
                <input type="number" name="stok" class="w-full px-4 py-2 rounded-lg border border-green-200 dark:border-green-200 bg-green-50 dark:bg-green-50 focus:ring-2 focus:ring-green-400 focus:outline-none transition" min="0" value="0" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-green-800 dark:text-green-900">Stok Minimum</label>
                <input type="number" name="stok_minimum" class="w-full px-4 py-2 rounded-lg border border-green-200 dark:border-green-200 bg-green-50 dark:bg-green-50 focus:ring-2 focus:ring-green-400 focus:outline-none transition" min="0" value="0" required>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 mt-6">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow transition w-full sm:w-auto block sm:inline-block">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    Simpan
                </button>
                <a href="{{ route('barangs.index') }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold shadow transition w-full sm:w-auto block sm:inline-block">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>