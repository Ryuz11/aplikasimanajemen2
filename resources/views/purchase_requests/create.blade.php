<x-app-layout>
    <div class="max-w-xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-blue-100/80 rounded-xl shadow-2xl p-4 sm:p-8 border border-blue-100 dark:border-blue-200">
            <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2m-4-4a4 4 0 00-4-4V7a4 4 0 018 0v2a4 4 0 00-4 4z" /></svg>
                Buat Permintaan Pembelian (PR)
            </h2>
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('purchase-requests.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-blue-800 dark:text-blue-900">Pilih Barang</label>
                    <select name="barang_id" class="w-full border border-blue-200 dark:border-blue-200 rounded px-3 py-2 bg-blue-50 dark:bg-blue-50" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}" @if(old('barang_id') == $barang->id) selected @endif>{{ $barang->nama }} (Stok: {{ $barang->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-blue-800 dark:text-blue-900">Jumlah</label>
                    <input type="number" name="qty" min="1" class="w-full border border-blue-200 dark:border-blue-200 rounded px-3 py-2 bg-blue-50 dark:bg-blue-50" required value="{{ old('qty', 1) }}">
                </div>
                <div class="mt-6 flex flex-col sm:flex-row gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full sm:w-auto block sm:inline-block">Kirim Permintaan</button>
                    <a href="{{ route('purchase-requests.index') }}" class="text-gray-600 hover:underline px-4 py-2 w-full sm:w-auto block sm:inline-block">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
