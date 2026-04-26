<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('medicines.index') }}" class="text-blue-600 hover:underline">
                ← Medicine List
            </a>
            <span class="text-gray-400">/</span>
            <h2 class="text-xl font-semibold text-gray-800">{{ $medicine->name }}</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl px-4 mx-auto">
            <div class="p-6 bg-white shadow rounded-2xl">

                {{-- Header --}}
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $medicine->name }}</h1>
                        <p class="mt-1 text-gray-500">{{ $medicine->generic_name }}</p>
                    </div>
                    <span class="px-3 py-1 text-sm text-blue-700 bg-blue-100 rounded-full">
                        {{ $medicine->category }}
                    </span>
                </div>

                {{-- Details --}}
                <div class="space-y-4">
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-500">Strength</span>
                        <span class="font-medium">{{ $medicine->strength }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-500">Manufacturer</span>
                        <span class="font-medium">{{ $medicine->manufacturer }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-500">Price</span>
                        <span class="text-xl font-bold text-green-600">৳ {{ number_format($medicine->price, 2) }}</span>
                    </div>
                    <div class="py-3">
                        <p class="mb-1 text-gray-500">Description</p>
                        <p class="text-gray-700">{{ $medicine->description }}</p>
                    </div>
                </div>

                {{-- Warning --}}
                <div class="p-4 mt-6 border border-yellow-200 bg-yellow-50 rounded-xl">
                    <p class="text-sm text-yellow-800">
                        ⚠️ <strong>সতর্কতা:</strong> ডাক্তারের পরামর্শ ছাড়া কোনো medicine সেবন করবেন না।
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>