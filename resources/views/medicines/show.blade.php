<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('medicines.index') }}" class="text-blue-600 hover:underline text-sm">← Medicine List</a>
            <span class="text-gray-400">/</span>
            <h2 class="font-semibold text-gray-800">{{ $medicine->name }}</h2>
        </div>
    </x-slot>

    @php
        $gradients = [
            'from-blue-500 to-blue-700',
            'from-indigo-500 to-indigo-700',
            'from-purple-500 to-purple-700',
            'from-green-500 to-green-700',
            'from-teal-500 to-teal-700',
        ];
        $grad = $gradients[$medicine->id % count($gradients)];
    @endphp

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Hero Card --}}
            <div class="bg-gradient-to-br {{ $grad }} rounded-3xl p-8 text-white mb-6 shadow-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-5xl mb-3">💊</div>
                        <h1 class="text-4xl font-bold mb-1">{{ $medicine->name }}</h1>
                        @if($medicine->generic_name)
                            <p class="text-white text-opacity-80 text-lg">{{ $medicine->generic_name }}</p>
                        @endif
                    </div>
                    @if($medicine->price)
                        <div class="text-right">
                            <div class="bg-white bg-opacity-20 rounded-2xl p-4 text-center">
                                <p class="text-white text-opacity-70 text-sm">Price</p>
                                <p class="text-3xl font-bold">৳{{ number_format($medicine->price, 2) }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Main Info --}}
                <div class="md:col-span-2 space-y-4">

                    {{-- Details Card --}}
                    <div class="bg-white rounded-2xl shadow p-6">
                        <h2 class="font-bold text-gray-800 text-lg mb-4">📋 Medicine Details</h2>
                        <div class="space-y-3">
                            @if($medicine->generic_name)
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-500 flex items-center gap-2">🧪 Generic Name</span>
                                    <span class="font-medium text-gray-800">{{ $medicine->generic_name }}</span>
                                </div>
                            @endif
                            @if($medicine->strength)
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-500 flex items-center gap-2">💪 Strength</span>
                                    <span class="font-medium text-gray-800">{{ $medicine->strength }}</span>
                                </div>
                            @endif
                            @if($medicine->manufacturer)
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-500 flex items-center gap-2">🏭 Manufacturer</span>
                                    <span class="font-medium text-gray-800">{{ $medicine->manufacturer }}</span>
                                </div>
                            @endif
                            @if($medicine->category)
                                <div class="flex justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-500 flex items-center gap-2">🏷️ Category</span>
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $medicine->category }}
                                    </span>
                                </div>
                            @endif
                            @if($medicine->price)
                                <div class="flex justify-between py-3">
                                    <span class="text-gray-500 flex items-center gap-2">💰 Price</span>
                                    <span class="font-bold text-green-600 text-xl">৳{{ number_format($medicine->price, 2) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($medicine->description)
                        <div class="bg-white rounded-2xl shadow p-6">
                            <h2 class="font-bold text-gray-800 text-lg mb-3">📖 Description / Indication</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $medicine->description }}</p>
                        </div>
                    @endif

                    {{-- Warning --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-5">
                        <div class="flex gap-3">
                            <span class="text-2xl">⚠️</span>
                            <div>
                                <p class="font-bold text-yellow-800 mb-1">সতর্কতা</p>
                                <p class="text-yellow-700 text-sm">
                                    ডাক্তারের পরামর্শ ছাড়া কোনো medicine সেবন করবেন না।
                                    এই তথ্য শুধুমাত্র সাধারণ জ্ঞানের জন্য।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-4">

                    {{-- Quick Actions --}}
                    <div class="bg-white rounded-2xl shadow p-5">
                        <h3 class="font-bold text-gray-700 mb-3">🔗 Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="{{ route('chat.index') }}"
                               class="block bg-blue-600 text-white text-center py-2.5 rounded-xl hover:bg-blue-700 text-sm font-medium">
                                💬 AI কে জিজ্ঞেস করুন
                            </a>
                            <a href="{{ route('medicines.index', ['search' => $medicine->generic_name]) }}"
                               class="block bg-gray-100 text-gray-700 text-center py-2.5 rounded-xl hover:bg-gray-200 text-sm">
                                🔍 Same Generic দেখুন
                            </a>
                            <a href="{{ route('medicines.index', ['manufacturer' => $medicine->manufacturer]) }}"
                               class="block bg-gray-100 text-gray-700 text-center py-2.5 rounded-xl hover:bg-gray-200 text-sm">
                                🏭 Same Company দেখুন
                            </a>
                        </div>
                    </div>

                    {{-- Related Medicines --}}
                    @if($related->count() > 0)
                        <div class="bg-white rounded-2xl shadow p-5">
                            <h3 class="font-bold text-gray-700 mb-3">💊 Same Generic</h3>
                            <div class="space-y-2">
                                @foreach($related as $rel)
                                    <a href="{{ route('medicines.show', $rel) }}"
                                       class="block bg-gray-50 hover:bg-blue-50 rounded-xl px-3 py-2.5 transition">
                                        <p class="font-medium text-gray-800 text-sm">{{ $rel->name }}</p>
                                        <div class="flex justify-between mt-0.5">
                                            <span class="text-xs text-gray-400">{{ $rel->strength }}</span>
                                            @if($rel->price)
                                                <span class="text-xs text-green-600 font-medium">৳{{ $rel->price }}</span>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
