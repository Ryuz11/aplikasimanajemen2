<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-purple-100/80 rounded-xl shadow-2xl p-8 border border-purple-100 dark:border-purple-200">
            <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6a2 2 0 012-2h12a2 2 0 012 2v8c0 2.21-3.582 4-8 4z" /></svg>
                Input Pembayaran
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
            <form method="POST" action="{{ route('payments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Pilih PO</label>
                    <select name="purchase_order_id" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required>
                        <option value="">-- Pilih PO --</option>
                        @foreach($purchaseOrders as $po)
                            <option value="{{ $po->id }}">{{ $po->po_number }} - {{ $po->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Pilih GRN</label>
                    <select name="goods_receipt_id" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required>
                        <option value="">-- Pilih GRN --</option>
                        @foreach($goodsReceipts as $grn)
                            <option value="{{ $grn->id }}">GRN #{{ $grn->id }} - {{ $grn->tanggal }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">No. Invoice</label>
                    <input type="text" name="invoice_number" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required value="{{ old('invoice_number') }}">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required value="{{ old('tanggal', date('Y-m-d')) }}">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Jumlah
                        <span class="block text-xs text-gray-500 font-normal">Masukkan total nominal pembayaran yang dibayarkan untuk PO/GRN ini (bisa pembayaran penuh atau sebagian).</span>
                    </label>
                    <input type="number" name="jumlah" min="0" step="0.01" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required value="{{ old('jumlah') }}">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Upload Bukti Pembayaran (opsional)</label>
                    <input type="file" name="bukti" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50">
                </div>
                <div class="mt-6 flex gap-2">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Simpan Pembayaran</button>
                    <a href="{{ route('payments.index') }}" class="text-gray-600 hover:underline px-4 py-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
