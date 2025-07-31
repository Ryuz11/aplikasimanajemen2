<x-app-layout>
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white/90 dark:bg-purple-100/80 shadow-2xl rounded-lg p-6 border border-purple-100 dark:border-purple-200">
        <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-800 mb-4">Detail Purchase Order</h2>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-4">
            <span class="font-semibold">PO Number:</span> {{ $po->po_number }}<br>
            <span class="font-semibold">Supplier:</span> {{ $po->supplier_name }}<br>
            <span class="font-semibold">Tanggal Order:</span> {{ $po->order_date }}<br>
            <span class="font-semibold">Status:</span> 
            <span class="inline-block px-2 py-1 rounded bg-purple-200 text-purple-900 dark:bg-purple-300 dark:text-purple-900">{{ ucfirst($po->status) }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold">Dari PR:</span> #{{ $po->purchaseRequest->id ?? '-' }}
        </div>
        <h3 class="font-semibold mb-2">Item PO</h3>
        <table class="min-w-full bg-white/80 dark:bg-purple-50/60 border">
            <thead class="bg-purple-50 dark:bg-purple-200/80">
                <tr>
                    <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Barang</th>
                    <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Qty</th>
                    <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($po->items as $item)
                <tr>
                    <td class="px-4 py-2 border">{{ $item->barang->nama ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $item->quantity }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($item->price,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('purchase-orders.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke daftar PO</a>
            @if(auth()->user()->hasRole('purchase'))
            <form method="POST" action="{{ route('purchase-orders.update-status', $po->id) }}" class="inline-block">
                @csrf
                <select name="status" class="border rounded px-2 py-1">
                    <option value="draft" @if($po->status=='draft') selected @endif>Draft</option>
                    <option value="sent" @if($po->status=='sent') selected @endif>Sent</option>
                    <option value="complete" @if($po->status=='complete') selected @endif>Complete</option>
                </select>
                <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 ml-2">Update Status</button>
            </form>
            @endif
        </div>
    </div>
</div>
</x-app-layout>