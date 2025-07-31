<x-app-layout>
    <div class="max-w-5xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-blue-100/80 rounded-xl shadow-2xl p-4 sm:p-8 border border-indigo-100 dark:border-blue-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <h1 class="text-2xl font-bold text-indigo-700 dark:text-indigo-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4V6a4 4 0 00-8 0v4m8 0a4 4 0 01-8 0m8 0v4a4 4 0 01-8 0v-4" /></svg>
                    Manajemen User
                </h1>
                <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow transition w-full sm:w-auto block sm:inline-block">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    Tambah User
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-indigo-100 dark:divide-blue-200 text-sm">
                    <thead class="bg-indigo-50 dark:bg-blue-200/80">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-indigo-800 dark:text-indigo-900">Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-indigo-800 dark:text-indigo-900">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-indigo-800 dark:text-indigo-900">Role</th>
                            <th class="px-4 py-3 text-center font-semibold text-indigo-800 dark:text-indigo-900">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/80 dark:bg-blue-50/60 divide-y divide-indigo-50 dark:divide-blue-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-indigo-100 dark:hover:bg-blue-200/60 transition">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td class="px-4 py-3 text-center flex flex-col sm:flex-row gap-2 justify-center">
                                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-1 px-3 py-1 rounded bg-yellow-400 hover:bg-yellow-500 text-white font-semibold shadow transition w-full sm:w-auto block sm:inline-block">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 17v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5a2 2 0 00-2 2z" /></svg>
                                    Edit
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded bg-red-500 hover:bg-red-600 text-white font-semibold shadow transition w-full sm:w-auto block sm:inline-block">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
