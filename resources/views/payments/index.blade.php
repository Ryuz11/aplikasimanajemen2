<x-app-layout>
    <div class="max-w-5xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-purple-100/80 rounded-xl shadow-2xl p-4 sm:p-8 border border-purple-100 dark:border-purple-200">
            <h2 class="text-2xl font-bold text-purple-700 dark:text-purple-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6a2 2 0 012-2h12a2 2 0 012 2v8c0 2.21-3.582 4-8 4z" /></svg>
                Daftar Pembayaran
            </h2>
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            <div class="mb-4 text-right">
                <a href="{{ route('payments.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 w-full sm:w-auto block sm:inline-block">Input Pembayaran</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white/80 dark:bg-purple-50/60 border text-sm">
                    <thead class="bg-purple-50 dark:bg-purple-200/80">
                        <tr>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">No</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Tanggal</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">PO</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">GRN</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Invoice</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Jumlah</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Status</th>
                            <th class="px-4 py-2 border text-purple-800 dark:text-purple-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                        <tr>
                            <td class="px-4 py-2 border">{{ $loop->iteration + ($payments->currentPage()-1)*$payments->perPage() }}</td>
                            <td class="px-4 py-2 border">{{ $payment->tanggal }}</td>
                            <td class="px-4 py-2 border">{{ $payment->purchaseOrder->po_number ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $payment->goodsReceipt->id ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $payment->invoice_number }}</td>
                            <td class="px-4 py-2 border">Rp {{ number_format($payment->jumlah,0,',','.') }}</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-block px-2 py-1 rounded bg-purple-200 text-purple-900 dark:bg-purple-300 dark:text-purple-900">{{ ucfirst($payment->status) }}</span>
                            </td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
