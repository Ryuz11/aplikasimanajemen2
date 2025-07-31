<x-app-layout>
    <div class="max-w-5xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-blue-100/80 rounded-xl shadow-2xl p-8 border border-blue-100 dark:border-blue-200">
            <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2m-4-4a4 4 0 00-4-4V7a4 4 0 018 0v2a4 4 0 00-4 4z" /></svg>
                Daftar Permintaan Pembelian (PR)
            </h2>
            @if(Auth::user()->hasRole('warehouse'))
            <div class="mb-6 text-right">
                <a href="{{ route('purchase-requests.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Buat Permintaan Pembelian</a>
            </div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-blue-100 dark:divide-blue-200 text-sm">
                    <thead class="bg-blue-50 dark:bg-blue-200/80">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-blue-800 dark:text-blue-900">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-blue-800 dark:text-blue-900">Barang</th>
                            <th class="px-4 py-3 text-right font-semibold text-blue-800 dark:text-blue-900">Qty</th>
                            <th class="px-4 py-3 text-left font-semibold text-blue-800 dark:text-blue-900">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-blue-800 dark:text-blue-900">Pemohon</th>
                            <th class="px-4 py-3 text-center font-semibold text-blue-800 dark:text-blue-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/80 dark:bg-blue-50/60 divide-y divide-blue-50 dark:divide-blue-100">
                        @foreach($purchaseRequests as $pr)
                        <tr>
                            <td class="px-4 py-3">{{ $pr->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $pr->barang->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-right">{{ $pr->qty }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                    @if($pr->status=='pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-200 dark:text-yellow-900
                                    @elseif($pr->status=='approved') bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900
                                    @else bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 @endif">
                                    {{ ucfirst($pr->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $pr->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                @if(Auth::user()->hasRole('purchase') && $pr->status=='pending')
                                    <form action="{{ route('purchase-requests.approve', $pr) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded bg-green-600 hover:bg-green-700 text-white font-semibold shadow transition">Approve</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $purchaseRequests->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
