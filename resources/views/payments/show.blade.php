<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-purple-100/80 rounded-xl shadow-2xl p-8 border border-purple-100 dark:border-purple-200">
            <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6a2 2 0 012-2h12a2 2 0 012 2v8c0 2.21-3.582 4-8 4z" /></svg>
                Detail Pembayaran
            </h2>
            <div class="mb-4">
                <span class="font-semibold">Tanggal:</span> {{ $payment->tanggal }}<br>
                <span class="font-semibold">PO:</span> {{ $payment->purchaseOrder->po_number ?? '-' }}<br>
                <span class="font-semibold">GRN:</span> {{ $payment->goodsReceipt->id ?? '-' }}<br>
                <span class="font-semibold">Invoice:</span> {{ $payment->invoice_number }}<br>
                <span class="font-semibold">Jumlah:</span> Rp {{ number_format($payment->jumlah,0,',','.') }}<br>
                <span class="font-semibold">Status:</span> <span class="inline-block px-2 py-1 rounded bg-purple-200 text-purple-900 dark:bg-purple-300 dark:text-purple-900">{{ ucfirst($payment->status) }}</span><br>
                <span class="font-semibold">Bukti:</span>
                @if($payment->bukti)
                    <a href="{{ asset('storage/'.$payment->bukti) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                @else
                    -
                @endif
            </div>
            @if(auth()->user()->hasRole('finance'))
            <form method="POST" action="{{ route('payments.update-status', $payment->id) }}" class="inline-block mt-4">
                @csrf
                <select name="status" class="border rounded px-2 py-1">
                    <option value="pending" @if($payment->status=='pending') selected @endif>Pending</option>
                    <option value="paid" @if($payment->status=='paid') selected @endif>Paid</option>
                </select>
                <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 ml-2">Update Status</button>
            </form>
            @endif
            <div class="mt-6">
                <a href="{{ route('payments.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke daftar pembayaran</a>
            </div>
        </div>
    </div>
</x-app-layout>
