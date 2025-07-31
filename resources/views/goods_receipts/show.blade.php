<x-app-layout>
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Detail Penerimaan Barang (GRN)</h2>
        <div class="mb-4">
            <span class="font-semibold">Tanggal:</span> {{ $grn->tanggal }}<br>
            <span class="font-semibold">PO:</span> {{ $grn->purchaseOrder->po_number ?? '-' }}<br>
            <span class="font-semibold">Kondisi:</span> {{ $grn->kondisi }}<br>
            <span class="font-semibold">Bukti:</span>
            @if($grn->bukti)
                <a href="{{ asset('storage/'.$grn->bukti) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
            @else
                -
            @endif
        </div>
        <h3 class="font-semibold mb-2">Barang Diterima</h3>
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Barang</th>
                    <th class="px-4 py-2 border">Qty</th>
                    <th class="px-4 py-2 border">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grn->items as $item)
                <tr>
                    <td class="px-4 py-2 border">{{ $item->barang->nama ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $item->jumlah_diterima }}</td>
                    <td class="px-4 py-2 border">{{ $item->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            <a href="{{ route('goods-receipts.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke daftar GRN</a>
        </div>
    </div>
</div>
</x-app-layout>