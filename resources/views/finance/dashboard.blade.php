<x-app-layout>
    <div class="max-w-6xl mx-auto mt-8 px-2 sm:px-4">
        <div class="bg-white/90 dark:bg-purple-100/80 rounded-2xl shadow-2xl p-4 sm:p-8 border border-purple-100 dark:border-purple-200">
            <h1 class="text-3xl font-bold text-purple-700 dark:text-purple-800 mb-8 flex items-center gap-3 flex-wrap">
                <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                Dashboard Finance
            </h1>
            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded bg-purple-100 text-purple-800 dark:bg-purple-200 dark:text-purple-900 font-semibold shadow">
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
                        <a href="{{ route('payments.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl bg-purple-50 dark:bg-purple-200 hover:bg-purple-100 dark:hover:bg-purple-300 text-purple-700 dark:text-purple-900 font-semibold shadow transition w-full">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" /></svg>
                            <span class="text-lg">Manajemen Pembayaran</span>
                        </a>
                    </li>
                </ul>
                <div class="md:col-span-2 flex flex-col gap-8">
                    <div class="overflow-x-auto rounded-xl bg-purple-50 dark:bg-purple-200 p-4 shadow">
                        <h2 class="text-lg font-bold mb-4 text-purple-700">Grafik Pembayaran</h2>
                        <div class="w-full min-w-[320px] max-w-full">
                            <canvas id="paymentChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // ...chart code finance...
            </script>
        </div>
    </div>
</x-app-layout>