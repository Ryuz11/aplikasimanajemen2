<x-app-layout>
    <div class="max-w-6xl mx-auto mt-8 px-2 sm:px-4">
        <div class="bg-white/90 dark:bg-blue-100/80 rounded-2xl shadow-2xl p-4 sm:p-8 border border-blue-100 dark:border-blue-200">
            <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-800 mb-8 flex items-center gap-3 flex-wrap">
                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                Dashboard Purchase
            </h1>
            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded bg-blue-100 text-blue-800 dark:bg-blue-200 dark:text-blue-900 font-semibold shadow">
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <ul class="space-y-6 md:space-y-8">
                    <li>
                        <a href="{{ route('purchase-requests.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl bg-blue-50 dark:bg-blue-200 hover:bg-blue-100 dark:hover:bg-blue-300 text-blue-700 dark:text-blue-900 font-semibold shadow transition w-full">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                            <span class="text-lg">Permintaan Pembelian (PR)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('purchase-orders.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl bg-green-50 dark:bg-green-200 hover:bg-green-100 dark:hover:bg-green-300 text-green-700 dark:text-green-900 font-semibold shadow transition w-full">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 018 0v2m-4-4a4 4 0 00-4-4V7a4 4 0 018 0v2a4 4 0 00-4 4z" /></svg>
                            <span class="text-lg">Purchase Order (PO)</span>
                        </a>
                    </li>
                </ul>
                <div class="md:col-span-2 flex flex-col gap-8">
                    <div class="overflow-x-auto rounded-xl bg-blue-50 dark:bg-blue-200 p-4 shadow">
                        <h2 class="text-lg font-bold mb-4 text-blue-700">Grafik PR</h2>
                        <div class="w-full min-w-[320px] max-w-full">
                            <canvas id="prChart" height="120"></canvas>
                        </div>
                    </div>
                    <div class="overflow-x-auto rounded-xl bg-green-50 dark:bg-green-200 p-4 shadow">
                        <h2 class="text-lg font-bold mb-4 text-green-700">Grafik PO</h2>
                        <div class="w-full min-w-[320px] max-w-full">
                            <canvas id="poChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // ...chart code purchase...
            </script>
        </div>
    </div>
</x-app-layout>
