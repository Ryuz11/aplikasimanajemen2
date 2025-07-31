<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-purple-100/80 rounded-xl shadow-2xl p-8 border border-purple-100 dark:border-purple-200">
            <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                Buat Purchase Order (PO)
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
            @if($purchaseRequests->count() === 0)
                <div class="p-4 bg-yellow-100 text-yellow-800 rounded mb-6">Tidak ada Purchase Request yang sudah disetujui. Silakan buat/approve PR terlebih dahulu.</div>
            @else
                <form method="GET" action="{{ route('purchase-orders.create') }}" class="mb-6">
                    <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Pilih Purchase Request</label>
                    <select name="pr_id" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" onchange="this.form.submit()">
                        <option value="">-- Pilih PR --</option>
                        @foreach($purchaseRequests as $pr)
                            <option value="{{ $pr->id }}" @if($purchaseRequest && $purchaseRequest->id == $pr->id) selected @endif>
                                PR #{{ $pr->id }} - {{ $pr->barang->nama ?? '-' }} (Qty: {{ $pr->qty }})
                            </option>
                        @endforeach
                    </select>
                </form>
                <form method="POST" action="{{ route('purchase-orders.store') }}">
                    @csrf
                    <input type="hidden" name="purchase_request_id" value="{{ $purchaseRequest->id ?? '' }}">
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Supplier</label>
                        <input type="text" name="supplier_name" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required value="{{ old('supplier_name') }}">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Tanggal Order</label>
                        <input type="date" name="order_date" class="w-full border border-purple-200 dark:border-purple-200 rounded px-3 py-2 bg-purple-50 dark:bg-purple-50" required value="{{ old('order_date', date('Y-m-d')) }}">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-purple-800 dark:text-purple-900">Barang & Jumlah</label>
                        <div class="space-y-2">
                            @if($purchaseRequest && $barangs->count())
                                @foreach($barangs as $barang)
                                <div class="flex items-center gap-2">
                                    <input type="hidden" name="items[{{ $barang->id }}][barang_id]" value="{{ $barang->id }}">
                                    <span>{{ $barang->nama }}</span>
                                    <input type="number" name="items[{{ $barang->id }}][quantity]" min="1" placeholder="Qty" class="w-20 border border-purple-200 dark:border-purple-200 rounded px-2 py-1 ml-2 bg-purple-50 dark:bg-purple-50" value="{{ $purchaseRequest->qty }}" required>
                                    <input type="number" name="items[{{ $barang->id }}][price]" min="0" step="0.01" placeholder="Harga" class="w-28 border border-purple-200 dark:border-purple-200 rounded px-2 py-1 ml-2 bg-purple-50 dark:bg-purple-50" value="{{ old('items.'.$barang->id.'.price') }}">
                                </div>
                                @endforeach
                            @else
                                <div class="text-gray-500 italic">Silakan pilih Purchase Request terlebih dahulu.</div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700" @if(!$purchaseRequest) disabled @endif>Simpan PO</button>
                        <a href="{{ route('purchase-orders.index') }}" class="text-gray-600 hover:underline px-4 py-2">Batal</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
