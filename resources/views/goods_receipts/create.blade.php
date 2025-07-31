<x-app-layout>

@section('content')
<div class="max-w-2xl mx-auto py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Input Penerimaan Barang (GRN)</h2>
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('goods-receipts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Pilih PO</label>
                <select name="purchase_order_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih PO --</option>
                    @foreach($purchaseOrders as $po)
                        <option value="{{ $po->id }}">{{ $po->po_number }} - {{ $po->supplier_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" required value="{{ old('tanggal', date('Y-m-d')) }}">
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Kondisi</label>
                <select name="kondisi" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="barang bagus" @if(old('kondisi')=='barang bagus') selected @endif>Barang Bagus</option>
                    <option value="barang rusak" @if(old('kondisi')=='barang rusak') selected @endif>Barang Rusak</option>
                    <option value="barang kadaluarsa" @if(old('kondisi')=='barang kadaluarsa') selected @endif>Barang Kadaluarsa</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Upload Bukti (opsional)</label>
                <input type="file" name="bukti" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Barang Diterima</label>
                <div id="barang-diterima-list" class="space-y-2">
                    @php $oldItems = old('items', [[]]); @endphp
                    @foreach($oldItems as $i => $item)
                    <div class="flex items-center gap-2">
                        <select name="items[{{ $i }}][barang_id]" class="border rounded px-2 py-1" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}" @if(isset($item['barang_id']) && $item['barang_id'] == $barang->id) selected @endif>{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="items[{{ $i }}][jumlah_diterima]" min="1" required placeholder="Qty" class="w-20 border rounded px-2 py-1 ml-2" value="{{ $item['jumlah_diterima'] ?? '' }}">
                        @error('items.'.$i.'.jumlah_diterima')
                            <span class="text-red-600 text-xs ml-1">{{ $message }}</span>
                        @enderror
                        <input type="text" name="items[{{ $i }}][keterangan]" placeholder="Keterangan" class="w-32 border rounded px-2 py-1 ml-2" value="{{ $item['keterangan'] ?? '' }}">
                        <button type="button" class="remove-barang bg-red-500 text-white rounded px-2 py-1 ml-2">Hapus</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="tambah-barang" class="mt-2 bg-green-600 text-white px-3 py-1 rounded">Tambah Barang</button>
            </div>
            <div class="mt-6 flex gap-2">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Simpan GRN</button>
                <a href="{{ route('goods-receipts.index') }}" class="text-gray-600 hover:underline px-4 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let idx = {{ count(old('items', [[]])) }};
    document.getElementById('tambah-barang').onclick = function() {
        const barangs = @json($barangs);
        let select = `<select name="items[${idx}][barang_id]" class="border rounded px-2 py-1" required><option value="">-- Pilih Barang --</option>`;
        barangs.forEach(b => {
            select += `<option value="${b.id}">${b.nama}</option>`;
        });
        select += `</select>`;
        const html = `<div class=\"flex items-center gap-2\">${select}<input type=\"number\" name=\"items[${idx}][jumlah_diterima]\" min=\"1\" required placeholder=\"Qty\" class=\"w-20 border rounded px-2 py-1 ml-2\"><input type=\"text\" name=\"items[${idx}][keterangan]\" placeholder=\"Keterangan\" class=\"w-32 border rounded px-2 py-1 ml-2\"><button type=\"button\" class=\"remove-barang bg-red-500 text-white rounded px-2 py-1 ml-2\">Hapus</button></div>`;
        document.getElementById('barang-diterima-list').insertAdjacentHTML('beforeend', html);
        idx++;
    };
    document.getElementById('barang-diterima-list').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-barang')) {
            e.target.parentElement.remove();
        }
    });
});
</script>
</x-app-layout>