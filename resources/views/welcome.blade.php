<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediAssist BD — AI Health Assistant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🏥</span>
                <span class="font-bold text-xl text-blue-600">MediAssist BD</span>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('medicines.index') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm">💊 Medicines</a>
                @auth
                    <a href="{{ route('chat.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 text-sm font-medium">
                        💬 AI Chat
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 text-sm font-medium">
                        শুরু করুন
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <div class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 py-24 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="text-7xl mb-6">🏥</div>
            <h1 class="text-5xl font-bold text-white mb-4 leading-tight">
                AI দিয়ে আপনার<br>স্বাস্থ্য সমস্যার সমাধান
            </h1>
            <p class="text-blue-100 text-xl mb-10 max-w-2xl mx-auto">
                Symptoms বলুন, AI আপনাকে সম্ভাব্য সমস্যা, করণীয় এবং
                বাংলাদেশী medicine suggest করবে।
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
                @auth
                    <a href="{{ route('chat.index') }}"
                       class="bg-white text-blue-600 font-bold px-8 py-4 rounded-2xl hover:bg-blue-50 shadow-xl text-lg">
                        💬 AI Chat শুরু করুন
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="bg-white text-blue-600 font-bold px-8 py-4 rounded-2xl hover:bg-blue-50 shadow-xl text-lg">
                        🚀 বিনামূল্যে শুরু করুন
                    </a>
                @endauth
                <a href="{{ route('medicines.index') }}"
                   class="bg-white bg-opacity-20 text-white font-bold px-8 py-4 rounded-2xl hover:bg-opacity-30 border border-white border-opacity-30 text-lg">
                    💊 Medicine খুঁজুন
                </a>
            </div>
        </div>
    </div>

    {{-- Features --}}
    <div class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-3">কেন MediAssist BD?</h2>
            <p class="text-gray-500 text-center mb-12">বাংলাদেশের সাধারণ মানুষের জন্য AI-powered স্বাস্থ্য সেবা</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="text-5xl mb-4">🤖</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">AI Health Assistant</h3>
                    <p class="text-gray-500">Gemini AI দিয়ে আপনার symptoms analyze করে সঠিক পরামর্শ দেয়</p>
                </div>
                <div class="bg-white rounded-3xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="text-5xl mb-4">💊</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">১৮,০০০+ Medicine</h3>
                    <p class="text-gray-500">বাংলাদেশের সব medicine এর তথ্য, price সহ একটি জায়গায়</p>
                </div>
                <div class="bg-white rounded-3xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="text-5xl mb-4">🇧🇩</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">বাংলায় উত্তর</h3>
                    <p class="text-gray-500">সম্পূর্ণ বাংলায় স্বাস্থ্য পরামর্শ পান, যেকোনো সময়</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold">১৮,৯৩১</div>
                    <div class="text-blue-100 mt-1">Medicine</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">২৪/৭</div>
                    <div class="text-blue-100 mt-1">AI Available</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">১০০%</div>
                    <div class="text-blue-100 mt-1">বাংলায়</div>
                </div>
                <div>
                    <div class="text-4xl font-bold">Free</div>
                    <div class="text-blue-100 mt-1">সম্পূর্ণ বিনামূল্যে</div>
                </div>
            </div>
        </div>
    </div>

    {{-- How it works --}}
    <div class="py-20 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">কীভাবে কাজ করে?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['1', '💬', 'Symptoms লিখুন', 'আপনার শারীরিক সমস্যা বাংলায় লিখুন'],
                    ['2', '🤖', 'AI Analyze করবে', 'Gemini AI আপনার symptoms বিশ্লেষণ করবে'],
                    ['3', '💊', 'Medicine পাবেন', 'বাংলাদেশী medicine সহ সম্পূর্ণ পরামর্শ পাবেন'],
                ] as $step)
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">
                            {{ $step[0] }}
                        </div>
                        <div class="text-4xl mb-3">{{ $step[1] }}</div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $step[2] }}</h3>
                        <p class="text-gray-500">{{ $step[3] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="py-20 px-4 text-center">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">এখনই শুরু করুন</h2>
            <p class="text-gray-500 mb-8">সম্পূর্ণ বিনামূল্যে, কোনো credit card লাগবে না</p>
            @auth
                <a href="{{ route('chat.index') }}"
                   class="bg-blue-600 text-white font-bold px-10 py-4 rounded-2xl hover:bg-blue-700 shadow-xl text-lg inline-block">
                    💬 AI Chat শুরু করুন
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="bg-blue-600 text-white font-bold px-10 py-4 rounded-2xl hover:bg-blue-700 shadow-xl text-lg inline-block">
                    🚀 বিনামূল্যে Register করুন
                </a>
            @endauth
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-gray-400 py-8 px-4 text-center">
        <p class="text-sm">⚠️ MediAssist BD শুধুমাত্র সাধারণ তথ্যের জন্য। Professional medical advice এর বিকল্প নয়।</p>
        <p class="text-sm mt-2">© 2026 MediAssist BD — Made with ❤️ for Bangladesh</p>
    </footer>

</body>
</html>
