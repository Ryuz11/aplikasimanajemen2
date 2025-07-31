<x-app-layout>
    <div class="max-w-5xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-purple-100/80 rounded-xl shadow-2xl p-4 sm:p-8 border border-purple-100 dark:border-purple-200">
            <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                Daftar Purchase Order (PO)
            </h2>
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            <div class="mb-4 text-right">
                <a href="{{ route('purchase-orders.create', ['pr_id' => $firstPurchaseRequest?->id ?? 1]) }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 w-full sm:w-auto block sm:inline-block">Buat PO Baru</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white/80 dark:bg-purple-50/60 border text-sm">
                    <thead class="bg-purple-50 dark:bg-purple-200/80">
                        <tr>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">No</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">PO Number</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Supplier</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Tanggal</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Status</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchaseOrders as $po)
                        <tr>
                            <td class="px-4 py-2 border">{{ $loop->iteration + ($purchaseOrders->currentPage()-1)*$purchaseOrders->perPage() }}</td>
                            <td class="px-4 py-2 border">{{ $po->po_number }}</td>
                            <td class="px-4 py-2 border">{{ $po->supplier_name }}</td>
                            <td class="px-4 py-2 border">{{ $po->order_date }}</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-block px-2 py-1 rounded bg-purple-200 text-purple-900 dark:bg-purple-300 dark:text-purple-900">{{ ucfirst($po->status) }}</span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('purchase-orders.show', $po->id) }}" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $purchaseOrders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
