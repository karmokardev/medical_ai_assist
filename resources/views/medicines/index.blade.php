<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">💊 Medicine Database</h2>
    </x-slot>

    {{-- Hero --}}
    <div class="py-12 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600">
        <div class="px-4 mx-auto text-center max-w-7xl">
            <h1 class="mb-2 text-4xl font-bold text-white">🏥 Bangladesh Medicine Database</h1>
            <p class="mb-8 text-lg text-blue-100">১৮,০০০+ medicine এর সম্পূর্ণ তথ্য</p>

            <form method="GET" action="{{ route('medicines.index') }}" class="flex max-w-2xl gap-2 mx-auto">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="🔍 Medicine নাম, generic name বা company লিখুন..."
                    class="flex-1 rounded-2xl border-0 px-5 py-3.5 text-gray-800 dark:text-gray-100 shadow-xl focus:ring-2 focus:ring-white text-sm"
                />
                <button type="submit"
                        class="bg-white dark:bg-gray-800 text-blue-600 font-bold px-6 py-3.5 rounded-2xl hover:bg-blue-50 shadow-xl whitespace-nowrap">
                    Search
                </button>
                @if(request()->hasAny(['search', 'category', 'manufacturer', 'price_min', 'price_max']))
                    <a href="{{ route('medicines.index') }}"
                       class="bg-red-500 text-white px-4 py-3.5 rounded-2xl hover:bg-red-600 shadow-xl">✕</a>
                @endif
            </form>

            {{-- Quick Category Buttons --}}
            <div class="flex flex-wrap justify-center gap-2 mt-6">
                @foreach($categories as $label => $value)
                    <a href="{{ route('medicines.index', ['category' => $value]) }}"
                       class="bg-white dark:bg-gray-800 bg-opacity-20 hover:bg-opacity-30 text-white text-sm px-4 py-2 rounded-full transition backdrop-blur-sm border border-white border-opacity-30
                       {{ request('category') == $value ? 'bg-white dark:bg-gray-800 text-blue-600 bg-opacity-100' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="min-h-screen py-8 bg-gray-50 dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex flex-col gap-6 lg:flex-row">

                {{-- Sidebar --}}
                <div class="w-full lg:w-72 shrink-0">

                    {{-- Filter Form --}}
                    <form method="GET" action="{{ route('medicines.index') }}">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        {{-- Price Filter --}}
                        <div class="p-5 mb-4 bg-white dark:bg-gray-800 shadow rounded-2xl">
                            <h3 class="mb-3 font-bold text-gray-700 dark:text-gray-200">💰 Price Filter</h3>
                            <div class="flex items-center gap-2">
                                <input type="number" name="price_min" value="{{ request('price_min') }}"
                                       placeholder="Min ৳"
                                       class="w-full text-sm border-gray-200 rounded-xl focus:ring-blue-500">
                                <span class="text-gray-400">—</span>
                                <input type="number" name="price_max" value="{{ request('price_max') }}"
                                       placeholder="Max ৳"
                                       class="w-full text-sm border-gray-200 rounded-xl focus:ring-blue-500">
                            </div>

                            {{-- Quick price ranges --}}
                            <div class="flex flex-wrap gap-1 mt-2">
                                @foreach([['0','10','৳০-১০'], ['0','50','৳০-৫০'], ['0','100','৳০-১০০'], ['100','500','৳১০০+']] as $range)
                                    <a href="{{ route('medicines.index', array_merge(request()->except(['price_min','price_max','page']), ['price_min'=>$range[0],'price_max'=>$range[1]])) }}"
                                       class="px-2 py-1 text-xs text-blue-600 rounded-lg bg-blue-50 hover:bg-blue-100">
                                        {{ $range[2] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Company Filter --}}
                        <div class="p-5 mb-4 bg-white dark:bg-gray-800 shadow rounded-2xl">
                            <h3 class="mb-3 font-bold text-gray-700 dark:text-gray-200">🏭 Company</h3>
                            <select name="manufacturer"
                                    class="w-full text-sm border-gray-200 rounded-xl focus:ring-blue-500">
                                <option value="">সব Company</option>
                                @foreach($manufacturers as $mfr)
                                    <option value="{{ $mfr }}" {{ request('manufacturer') == $mfr ? 'selected' : '' }}>
                                        {{ $mfr }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                                class="w-full py-3 font-medium text-white bg-blue-600 rounded-2xl hover:bg-blue-700">
                            🔍 Filter Apply করুন
                        </button>
                    </form>

                    {{-- Stats --}}
                    <div class="p-5 mt-4 text-white bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl">
                        <h3 class="mb-3 font-bold">📊 Database Stats</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-blue-100">Total Medicines</span>
                                <span class="font-bold">১৮,৯৩১+</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-blue-100">Search Results</span>
                                <span class="font-bold">{{ number_format($medicines->total()) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="flex-1">

                    {{-- Active Filters --}}
                    @if(request()->hasAny(['search', 'category', 'manufacturer', 'price_min', 'price_max']))
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="self-center text-sm text-gray-500 dark:text-gray-400">Active filters:</span>
                            @if(request('search'))
                                <span class="px-3 py-1 text-sm text-blue-700 bg-blue-100 rounded-full">
                                    🔍 "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('category'))
                                <span class="px-3 py-1 text-sm text-purple-700 bg-purple-100 rounded-full">
                                    💊 {{ request('category') }}
                                </span>
                            @endif
                            @if(request('manufacturer'))
                                <span class="px-3 py-1 text-sm text-green-700 bg-green-100 rounded-full">
                                    🏭 {{ request('manufacturer') }}
                                </span>
                            @endif
                            @if(request('price_min') || request('price_max'))
                                <span class="px-3 py-1 text-sm text-yellow-700 bg-yellow-100 rounded-full">
                                    💰 ৳{{ request('price_min', 0) }} - ৳{{ request('price_max', '∞') }}
                                </span>
                            @endif
                        </div>
                    @endif

                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                        মোট <span class="font-bold text-blue-600">{{ number_format($medicines->total()) }}</span> টি medicine পাওয়া গেছে
                    </p>

                    {{-- Medicine Grid --}}
                    @php
                        $gradients = [
                            'from-blue-500 to-blue-600',
                            'from-indigo-500 to-indigo-600',
                            'from-purple-500 to-purple-600',
                            'from-green-500 to-green-600',
                            'from-teal-500 to-teal-600',
                            'from-cyan-500 to-cyan-600',
                            'from-orange-500 to-orange-600',
                            'from-red-500 to-red-600',
                            'from-pink-500 to-pink-600',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @forelse($medicines as $index => $medicine)
                            @php $grad = $gradients[($medicine->id) % count($gradients)]; @endphp
                            <div class="overflow-hidden transition-all duration-300 bg-white dark:bg-gray-800 shadow cursor-pointer rounded-2xl hover:shadow-xl group"
                                 onclick="window.location='{{ route('medicines.show', $medicine) }}'">

                                {{-- Gradient Header --}}
                                <div class="bg-gradient-to-r {{ $grad }} px-5 py-4">
                                    <div class="flex items-start justify-between">
                                        <h3 class="text-lg font-bold leading-tight text-white">
                                            {{ $medicine->name }}
                                        </h3>
                                        @if($medicine->price)
                                            <span class="px-2 py-1 ml-2 text-sm font-bold text-white bg-white dark:bg-gray-800 rounded-lg bg-opacity-20 whitespace-nowrap">
                                                ৳{{ number_format($medicine->price, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($medicine->generic_name)
                                        <p class="mt-1 text-sm text-white text-opacity-80">{{ $medicine->generic_name }}</p>
                                    @endif
                                </div>

                                {{-- Card Body --}}
                                <div class="px-5 py-4">
                                    <div class="space-y-2 text-sm">
                                        @if($medicine->strength)
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-400">💪</span>
                                                <span class="text-gray-600 dark:text-gray-300">{{ $medicine->strength }}</span>
                                            </div>
                                        @endif
                                        @if($medicine->manufacturer)
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-400">🏭</span>
                                                <span class="text-gray-600 dark:text-gray-300 truncate">{{ $medicine->manufacturer }}</span>
                                            </div>
                                        @endif
                                        @if($medicine->description)
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400">📋</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">{{ Str::limit($medicine->description, 80) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center justify-between pt-3 mt-4 border-t border-gray-100 dark:border-gray-700">
                                        @if($medicine->category)
                                            <span class="px-2 py-1 text-xs text-blue-600 rounded-full bg-blue-50">
                                                {{ $medicine->category }}
                                            </span>
                                        @else
                                            <span></span>
                                        @endif
                                        <span class="text-sm font-medium text-blue-600 group-hover:underline">
                                            Details →
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 py-16 text-center bg-white dark:bg-gray-800 rounded-2xl">
                                <div class="mb-4 text-6xl">🔍</div>
                                <p class="text-lg font-medium text-gray-500 dark:text-gray-400">কোনো medicine পাওয়া যায়নি</p>
                                <a href="{{ route('medicines.index') }}"
                                   class="inline-block mt-2 text-blue-600 hover:underline">
                                    সব medicine দেখুন
                                </a>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                        {{ $medicines->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
const searchInput = document.querySelector('input[name="search"]');
if (searchInput) {
    let timeout;
    let dropdown = document.createElement('div');
    dropdown.className = 'absolute bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 w-full mt-1 z-50 hidden max-h-64 overflow-y-auto';
    searchInput.parentElement.style.position = 'relative';
    searchInput.parentElement.appendChild(dropdown);

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        const query = this.value.trim();
        if (query.length < 2) { dropdown.classList.add('hidden'); return; }

        timeout = setTimeout(async () => {
            const res = await fetch(`/medicines/search?q=${encodeURIComponent(query)}`);
            const data = await res.json();

            if (data.length === 0) { dropdown.classList.add('hidden'); return; }

            dropdown.innerHTML = data.map(m => `
                <a href="/medicines/${m.id}"
                   class="flex items-center justify-between px-4 py-3 transition border-b dark:border-gray-700 hover:bg-blue-50 border-gray-50 last:border-0">
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">${m.name}</p>
                        <p class="text-xs text-gray-400">${m.generic_name || ''}</p>
                    </div>
                    ${m.price ? `<span class="text-sm font-bold text-green-600">৳${m.price}</span>` : ''}
                </a>
            `).join('');
            dropdown.classList.remove('hidden');
        }, 300);
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target)) dropdown.classList.add('hidden');
    });
}
</script>
</x-app-layout>
