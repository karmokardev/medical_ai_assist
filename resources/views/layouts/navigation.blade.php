<nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <div class="flex items-center justify-center text-lg text-white shadow w-9 h-9 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl">
                        🏥
                    </div>
                    <span class="text-xl font-bold text-gray-800">Medi<span class="text-blue-600">Assist</span></span>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="items-center hidden gap-1 md:flex">
                    <a href="{{ url('/') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->is('/') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                        🏠 Home
                    </a>
                    <a href="{{ route('medicines.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('medicines.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                        💊 Medicines
                    </a>
                    @auth
                    <a href="{{ route('chat.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('chat.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                        💬 AI Chat
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium transition
                           {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                            ⚙️ Admin
                        </a>
                    @endif
                    @endauth
                </div>
            </div>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">
                @auth
                    <button class="flex items-center justify-center text-gray-500 transition w-9 h-9 rounded-xl hover:bg-gray-100">
                        🔔
                    </button>

                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center gap-2 px-3 py-2 transition bg-gray-100 hover:bg-gray-200 rounded-xl">
                            <div class="flex items-center justify-center text-xs font-bold text-white rounded-lg w-7 h-7 bg-gradient-to-br from-blue-500 to-indigo-500">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden text-sm font-medium text-gray-700 md:block">
                                {{ Str::limit(Auth::user()->name, 12) }}
                            </span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition
                             class="absolute right-0 z-50 py-2 mt-2 bg-white border border-gray-100 shadow-xl w-52 rounded-2xl">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full
                                    {{ Auth::user()->isAdmin() ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                    {{ Auth::user()->isAdmin() ? '👑 Admin' : '👤 User' }}
                                </span>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 transition">
                                <span>👤</span> Profile
                            </a>
                            <a href="{{ route('chat.index') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 transition">
                                <span>💬</span> My Chats
                            </a>

                            {{-- শুধু Admin দেখবে --}}
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-purple-600 hover:bg-purple-50 transition">
                                    <span>⚙️</span> Admin Panel
                                </a>
                            @endif

                            <div class="pt-2 mt-2 border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition w-full text-left">
                                        <span>🚪</span> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-medium text-gray-600 transition hover:text-blue-600 rounded-xl hover:bg-gray-100">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm font-medium text-white transition shadow bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:opacity-90">
                        🚀 Register
                    </a>
                @endauth

                {{-- Mobile menu button --}}
                <button class="flex items-center justify-center text-gray-500 md:hidden w-9 h-9 rounded-xl hover:bg-gray-100"
                        x-data
                        @click="$dispatch('toggle-menu')">
                    ☰
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="border-t border-gray-100 md:hidden"
         x-data="{ open: false }"
         @toggle-menu.window="open = !open"
         x-show="open"
         x-transition>
        <div class="px-4 py-3 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-100">🏠 Home</a>
            <a href="{{ route('medicines.index') }}" class="block px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-100">💊 Medicines</a>
            @auth
                <a href="{{ route('chat.index') }}" class="block px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-100">💬 AI Chat</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-sm text-purple-600 hover:bg-purple-50">⚙️ Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2.5 rounded-xl text-sm text-red-500 hover:bg-red-50">🚪 Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-gray-100">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2.5 rounded-xl text-sm text-blue-600 hover:bg-blue-50">🚀 Register</a>
            @endauth
        </div>
    </div>
</nav>
