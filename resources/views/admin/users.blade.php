<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">👤 All Users</h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded-2xl">
                <table class="w-full text-sm">
                    <thead class="text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Conversations</th>
                            <th class="px-4 py-3 text-left">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:bg-gray-900">
                                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full text-xs">
                                        {{ $user->conversations_count }} chats
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-400">{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>