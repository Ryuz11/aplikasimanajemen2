<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 min-h-screen bg-white shadow-lg border-r">
            <div class="p-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Menu Warehouse</h2>
                <nav class="space-y-2">
                    <!-- Manajemen Stok -->
                    <a href="{{ route('barangs.index') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-50 p-3 rounded-lg transition-colors {{ request()->routeIs('barangs.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <span>Manajemen Stok Opname</span>
                    </a>

                    <!-- Penerimaan Barang -->
                    <a href="{{ route('goods-receipts.index') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-50 p-3 rounded-lg transition-colors {{ request()->routeIs('goods-receipts.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Penerimaan Barang</span>
                    </a>

                    <!-- Permintaan Barang -->
                    <a href="{{ route('purchase-requests.index') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-50 p-3 rounded-lg transition-colors {{ request()->routeIs('purchase-requests.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span>Permintaan Barang</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-6xl mx-auto">
                <div >
            <h1 class="text-3xl font-bold text-green-700 dark:text-green-800 mb-8 flex items-center gap-3 flex-wrap">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                Dashboard Warehouse
            </h1>
            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 font-semibold shadow">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 font-semibold shadow">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Card Metrik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100 flex flex-col justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h16a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z" />
                        </svg>
                        <span class="font-semibold text-lg">Barang Menunggu Penerimaan</span>
                    </div>
                    <div class="mt-4 text-3xl font-bold text-blue-700">{{ $waitingReceipts }}</div>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100 flex flex-col justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-semibold text-lg">Stok Mendekati Minimum</span>
                    </div>
                    <div class="mt-4 text-3xl font-bold text-blue-700">{{ $pendingStockOpnames }}</div>
                    <div class="mt-1 text-sm text-gray-500">Perlu pemeriksaan segera</div>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100 flex flex-col justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="font-semibold text-lg">Permintaan Barang Baru</span>
                        <span class="ml-auto text-sm text-gray-500"></span>
                    </div>
                    <div class="mt-4 text-3xl font-bold text-blue-700">{{ $purchaseRequests->where('created_at', '>=', now()->startOfMonth())->where('status', 'pending')->count() }}</div>
                    <div class="mt-1 text-sm text-gray-500">{{ $purchaseRequests->where('status', 'pending')->count() }} total menunggu</div>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100 flex flex-col justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16V4H4zm4 4h8v8H8V8z" />
                        </svg>
                        <span class="font-semibold text-lg">Total Stok Tersedia</span>
                    </div>
                    <div class="mt-4 text-3xl font-bold text-blue-700">{{ $totalStock }}</div>
                </div>
            </div>
            <!-- Lists Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Penerimaan Terbaru yang Perlu Diproses -->
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h16a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z" />
                        </svg>
                        <span class="font-semibold">Penerimaan Terbaru yang Perlu Diproses</span>
                    </div>
                    <ul class="divide-y divide-blue-100">
                        @forelse($latestReceipts as $receipt)
                            <li class="py-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">{{ $receipt->barang->nama ?? 'Barang tidak ditemukan' }}</span>
                                    <a href="{{ route('goods-receipts.show', $receipt->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                </div>
                                <div class="mt-1 flex items-center gap-2">
                                    <div class="text-sm text-gray-500">
                                        Qty: {{ $receipt->qty }}
                                        @if($receipt->purchaseOrder)
                                            - {{ $receipt->purchaseOrder->supplier_name }}
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-2 text-gray-400">Tidak ada data.</li>
                        @endforelse
                    </ul>
                <div class="md:col-span-2 flex flex-col gap-8">
                    <div class="overflow-x-auto rounded-xl bg-green-50 dark:bg-green-200 p-4 shadow">
                        <h2 class="text-lg font-bold mb-4 text-green-700">Grafik Stok Barang</h2>
                        <div class="w-full min-w-[320px] max-w-full">
                            <canvas id="stokChart" height="120"></canvas>
                </div>
                <!-- Permintaan Barang Mendesak -->
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h16a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z" />
                        </svg>
                        <span class="font-semibold">Permintaan Barang </span>
                    </div>
                    <ul class="divide-y divide-blue-100">
                        @forelse($urgentRequests as $request)
                            <li class="py-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">{{ $request->barang->nama ?? 'Barang tidak ditemukan' }}</span>
                                    <a href="{{ route('purchase-requests.show', $request->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                </div>
                                <div class="mt-1 flex items-center gap-2">
                                    <div class="text-sm text-gray-500">
                                        Qty: {{ $request->qty }} - {{ $request->user->name ?? 'User tidak diketahui' }}
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-2 text-gray-400">Tidak ada data.</li>
                        @endforelse
                    </ul>
                </div>
                <!-- Jadwal Stok Opname Mendatang -->
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-semibold">Barang Stok Minimum</span>
                    </div>
                    <ul class="divide-y divide-blue-100">
                        @forelse($upcomingStockOpnames as $barang)
                            <li class="py-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">{{ $barang->nama }}</span>
                                    <a href="{{ route('barangs.show', $barang->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                </div>
                                <div class="mt-1 flex items-center gap-2">
                                    <div class="text-sm">
                                        <span class="text-gray-500">Stok: </span>
                                        <span class="font-medium {{ $barang->stok <= $barang->stok_minimum ? 'text-red-600' : 'text-yellow-600' }}">
                                            {{ $barang->stok }}
                                        </span>
                                    </div>
                                    <div class="text-sm">
                    if (document.getElementById('stokChart')) {
                                        <span class="text-gray-500">Min: </span>
                                        <span class="font-medium text-gray-600">{{ $barang->stok_minimum }}</span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-2 text-gray-400">Semua stok dalam kondisi aman</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            
            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100">
                    <h3 class="text-lg font-semibold mb-4">Grafik Stok Barang</h3>
                    <canvas id="stokChart"></canvas>
                </div>
                <div class="bg-white rounded-xl shadow p-6 border border-blue-100">
                    <h3 class="text-lg font-semibold mb-4">Trend Permintaan Pembelian</h3>
                    <canvas id="prChart"></canvas>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Data stok barang
                    const barangLabels = @json($barangs->pluck('nama'));
                    const barangStok = @json($barangs->pluck('stok'));
                    if (document.getElementById('stokChart')) {
                        new Chart(document.getElementById('stokChart'), {
                            type: 'bar',
                            data: {
                                labels: barangLabels,
                                datasets: [{
                                    label: 'Stok',
                                    data: barangStok,
                                    backgroundColor: 'rgba(16,185,129,0.5)',
                                    borderColor: 'rgba(16,185,129,1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {legend: {display: false}},
                                animation: false
                            }
                        });
                    }

                    // Data PR per bulan
                    const prLabels = @json($prPerMonth->pluck('bulan')->map(function($b) {
                        return \Carbon\Carbon::createFromFormat('Y-m', $b)->format('M Y');
                    }));
                    const prData = @json($prPerMonth->pluck('total'));
                    if (document.getElementById('prChart')) {
                        new Chart(document.getElementById('prChart'), {
                            type: 'line',
                            data: {
                                labels: prLabels,
                                datasets: [{
                                    label: 'Jumlah PR',
                                    data: prData,
                                    backgroundColor: 'rgba(59,130,246,0.2)',
                                    borderColor: 'rgba(59,130,246,1)',
                                    borderWidth: 2,
                                    tension: 0.3
                                }]
                            },
                            options: {
                                responsive: true,
                                animation: false
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>
