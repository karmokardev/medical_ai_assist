<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">👤 My Profile</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Profile Card --}}
                <div class="md:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-4xl font-bold text-white mx-auto mb-4 shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 text-xl">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-400 text-sm mt-1">{{ Auth::user()->email }}</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-400">Member since</p>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl p-5 mt-4 text-white">
                        <h3 class="font-bold mb-3 text-sm">📊 Your Stats</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-100">Total Chats</span>
                                <span class="font-bold">{{ Auth::user()->conversations()->count() }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-blue-100">Total Messages</span>
                                <span class="font-bold">
                                    {{ Auth::user()->conversations()->withCount('messages')->get()->sum('messages_count') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Edit Forms --}}
                <div class="md:col-span-2 space-y-4">

                    {{-- Update Name/Email --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 mb-4">✏️ Profile Update</h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                           class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                           class="w-full rounded-xl border-gray-200 focus:ring-blue-500 focus:border-blue-500">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <button type="submit"
                                        class="bg-blue-600 text-white px-6 py-2.5 rounded-xl hover:bg-blue-700 font-medium text-sm">
                                    ✅ Update করুন
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Update Password --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 mb-4">🔐 Password Change</h3>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Current Password</label>
                                    <input type="password" name="current_password"
                                           class="w-full rounded-xl border-gray-200 focus:ring-blue-500">
                                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">New Password</label>
                                    <input type="password" name="password"
                                           class="w-full rounded-xl border-gray-200 focus:ring-blue-500">
                                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Confirm Password</label>
                                    <input type="password" name="password_confirmation"
                                           class="w-full rounded-xl border-gray-200 focus:ring-blue-500">
                                </div>
                                <button type="submit"
                                        class="bg-green-600 text-white px-6 py-2.5 rounded-xl hover:bg-green-700 font-medium text-sm">
                                    🔐 Password Change করুন
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Recent Chats --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-800 dark:text-gray-100">💬 Recent Chats</h3>
                            <a href="{{ route('chat.index') }}" class="text-blue-600 text-sm hover:underline">সব দেখুন</a>
                        </div>
                        <div class="space-y-2">
                            @forelse(Auth::user()->conversations()->latest()->take(5)->get() as $conv)
                                <a href="{{ route('chat.show', $conv) }}"
                                   class="flex justify-between items-center bg-gray-50 dark:bg-gray-900 hover:bg-blue-50 rounded-xl px-4 py-3 transition">
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg">💬</span>
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Str::limit($conv->title, 35) }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $conv->created_at->diffForHumans() }}</span>
                                </a>
                            @empty
                                <p class="text-gray-400 text-sm text-center py-4">কোনো chat নেই</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
