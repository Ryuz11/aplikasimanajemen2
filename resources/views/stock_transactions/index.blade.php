<x-app-layout>
    <div class="max-w-4xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-green-100/80 rounded-xl shadow-2xl p-8 border border-green-100 dark:border-green-200">
            <h1 class="text-2xl font-bold text-green-700 dark:text-green-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Riwayat Transaksi Stok
            </h1>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-green-100 dark:divide-green-200 text-sm">
                    <thead class="bg-green-50 dark:bg-green-200/80">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Tipe</th>
                            <th class="px-4 py-3 text-right font-semibold text-green-800 dark:text-green-900">Qty</th>
                            <th class="px-4 py-3 text-left font-semibold text-green-800 dark:text-green-900">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/80 dark:bg-green-50/60 divide-y divide-green-50 dark:divide-green-100">
                        @foreach($transactions as $trx)
                        <tr>
                            <td class="px-4 py-3">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $trx->barang->nama ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                    @if($trx->type=='in') bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900
                                    @elseif($trx->type=='out') bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900
                                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-200 dark:text-yellow-900 @endif">
                                    {{ strtoupper($trx->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">{{ $trx->qty }}</td>
                            <td class="px-4 py-3">{{ $trx->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
