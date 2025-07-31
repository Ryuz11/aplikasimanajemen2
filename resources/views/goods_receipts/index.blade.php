<x-app-layout>

<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6">
        <h2 class="text-2xl font-bold mb-4">Daftar Penerimaan Barang (GRN)</h2>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-4 text-right">
            <a href="{{ route('goods-receipts.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 w-full sm:w-auto block sm:inline-block">Input GRN</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">PO</th>
                        <th class="px-4 py-2 border">Kondisi</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($goodsReceipts as $grn)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loop->iteration + ($goodsReceipts->currentPage()-1)*$goodsReceipts->perPage() }}</td>
                        <td class="px-4 py-2 border">{{ $grn->tanggal }}</td>
                        <td class="px-4 py-2 border">{{ $grn->purchaseOrder->po_number ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $grn->kondisi }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('goods-receipts.show', $grn->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data GRN.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $goodsReceipts->links() }}</div>
    </div>
</div>
</x-app-layout>