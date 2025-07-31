<x-app-layout>
    <div class="max-w-xl mx-auto mt-8">
        <div class="bg-white/90 dark:bg-blue-100/80 rounded-xl shadow-2xl p-8 border border-indigo-100 dark:border-blue-200">
            <h1 class="text-2xl font-bold text-indigo-700 dark:text-indigo-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Tambah User
            </h1>
            <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block mb-1 font-semibold text-indigo-800 dark:text-indigo-900">Name</label>
                    <input type="text" name="name" class="w-full px-4 py-2 rounded-lg border border-indigo-200 dark:border-blue-200 bg-indigo-50 dark:bg-blue-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-indigo-800 dark:text-indigo-900">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 rounded-lg border border-indigo-200 dark:border-blue-200 bg-indigo-50 dark:bg-blue-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-indigo-800 dark:text-indigo-900">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 rounded-lg border border-indigo-200 dark:border-blue-200 bg-indigo-50 dark:bg-blue-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-indigo-800 dark:text-indigo-900">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 rounded-lg border border-indigo-200 dark:border-blue-200 bg-indigo-50 dark:bg-blue-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold text-indigo-800 dark:text-indigo-900">Role</label>
                    <select name="role" class="w-full px-4 py-2 rounded-lg border border-indigo-200 dark:border-blue-200 bg-indigo-50 dark:bg-blue-50 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        Save
                    </button>
                    <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold shadow transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
