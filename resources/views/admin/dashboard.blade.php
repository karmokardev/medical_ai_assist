<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">⚙️ Admin Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl">

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-4 mb-8 md:grid-cols-4">
                <div class="p-6 text-center bg-white dark:bg-gray-800 shadow rounded-2xl">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['users'] }}</div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">👤 Total Users</div>
                </div>
                <div class="p-6 text-center bg-white dark:bg-gray-800 shadow rounded-2xl">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['medicines'] }}</div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">💊 Medicines</div>
                </div>
                <div class="p-6 text-center bg-white dark:bg-gray-800 shadow rounded-2xl">
                    <div class="text-3xl font-bold text-purple-600">{{ $stats['conversations'] }}</div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">💬 Conversations</div>
                </div>
                <div class="p-6 text-center bg-white dark:bg-gray-800 shadow rounded-2xl">
                    <div class="text-3xl font-bold text-orange-600">{{ $stats['messages'] }}</div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">✉️ Messages</div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                {{-- Recent Users --}}
                <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-200">👤 Recent Users</h3>
                        <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:underline">সব দেখুন</a>
                    </div>
                    <div class="space-y-3">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center justify-between py-2 border-b">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-gray-100">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                </div>
                                <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Recent Conversations --}}
                <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-200">💬 Recent Conversations</h3>
                    </div>
                    <div class="space-y-3">
                        @foreach($recentConversations as $conv)
                            <div class="flex items-center justify-between py-2 border-b">
                                <div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $conv->title }}</p>
                                    <p class="text-xs text-gray-400">{{ $conv->user->name }}</p>
                                </div>
                                <span class="text-xs text-gray-400">{{ $conv->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="flex gap-4 mt-6">
                <a href="{{ route('admin.medicines') }}"
                   class="px-6 py-3 text-white bg-green-600 rounded-xl hover:bg-green-700">
                    💊 Medicines Manage করুন
                </a>
                <a href="{{ route('admin.users') }}"
                   class="px-6 py-3 text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                    👤 Users দেখুন
                </a>
            </div>

        </div>
    </div>
</x-app-layout>