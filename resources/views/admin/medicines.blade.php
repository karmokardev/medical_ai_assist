<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">💊 All Medicines</h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded-2xl">
                <table class="w-full text-sm">
                    <thead class="text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Generic</th>
                            <th class="px-4 py-3 text-left">Category</th>
                            <th class="px-4 py-3 text-left">Manufacturer</th>
                            <th class="px-4 py-3 text-left">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($medicines as $med)
                            <tr class="hover:bg-gray-50 dark:bg-gray-900">
                                <td class="px-4 py-3 font-medium">{{ $med->name }}</td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $med->generic_name }}</td>
                                <td class="px-4 py-3">
                                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs">
                                        {{ $med->category }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $med->manufacturer }}</td>
                                <td class="px-4 py-3 font-medium text-green-600">৳{{ $med->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>