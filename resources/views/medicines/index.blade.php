<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            💊 Medicine List
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl">

            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('medicines.index') }}"
                  class="flex flex-col gap-3 mb-6 md:flex-row">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Medicine নাম বা generic name দিয়ে search করুন..."
                    class="flex-1 border-gray-300 shadow-sm rounded-xl focus:ring-blue-500 focus:border-blue-500"
                />
                <select name="category"
                        class="border-gray-300 shadow-sm rounded-xl focus:ring-blue-500">
                    <option value="">সব Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                        class="px-6 py-2 text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                    🔍 Search
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('medicines.index') }}"
                       class="px-6 py-2 text-center text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300">
                        ✕ Clear
                    </a>
                @endif
            </form>

            {{-- Results count --}}
            <p class="mb-4 text-sm text-gray-500">
                মোট {{ $medicines->total() }} টি medicine পাওয়া গেছে
            </p>

            {{-- Medicine Grid --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse($medicines as $medicine)
                    <div class="p-5 transition bg-white shadow rounded-2xl hover:shadow-md">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $medicine->name }}
                            </h3>
                            <span class="px-2 py-1 text-xs text-blue-700 bg-blue-100 rounded-full">
                                {{ $medicine->category }}
                            </span>
                        </div>
                        <p class="mb-1 text-sm text-gray-500">
                            Generic: <span class="font-medium text-gray-700">{{ $medicine->generic_name }}</span>
                        </p>
                        <p class="mb-1 text-sm text-gray-500">
                            Strength: <span class="font-medium text-gray-700">{{ $medicine->strength }}</span>
                        </p>
                        <p class="mb-3 text-sm text-gray-500">
                            Manufacturer: <span class="font-medium text-gray-700">{{ $medicine->manufacturer }}</span>
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-green-600">
                                ৳ {{ number_format($medicine->price, 2) }}
                            </span>
                            <a href="{{ route('medicines.show', $medicine) }}"
                               class="bg-blue-600 text-white text-sm px-4 py-1.5 rounded-lg hover:bg-blue-700">
                                Details →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 py-12 text-center text-gray-400">
                        <p class="mb-2 text-4xl">💊</p>
                        <p>কোনো medicine পাওয়া যায়নি</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $medicines->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>