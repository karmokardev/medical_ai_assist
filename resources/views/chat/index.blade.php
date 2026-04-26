<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            💬 AI Health Assistant
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl px-4 mx-auto">
            <div class="p-8 text-center bg-white shadow rounded-2xl">
                <div class="mb-4 text-6xl">🏥</div>
                <h1 class="mb-2 text-2xl font-bold text-gray-800">MediAssist BD</h1>
                <p class="mb-8 text-gray-500">আপনার symptoms বলুন, AI আপনাকে সাহায্য করবে</p>

                <form method="POST" action="{{ route('chat.store') }}">
                    @csrf
                    <input type="hidden" name="message" value="নতুন chat শুরু করুন">
                    <button type="submit"
                            class="px-8 py-3 font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                        + নতুন Chat শুরু করুন
                    </button>
                </form>

                {{-- Previous Conversations --}}
                @if($conversations->count() > 0)
                    <div class="mt-8 text-left">
                        <h3 class="mb-3 font-semibold text-gray-700">আগের Conversations</h3>
                        <div class="space-y-2">
                            @foreach($conversations as $conv)
                                <a href="{{ route('chat.show', $conv) }}"
                                   class="block px-4 py-3 text-sm text-gray-700 transition border border-gray-100 bg-gray-50 hover:bg-blue-50 rounded-xl hover:border-blue-200">
                                    💬 {{ $conv->title }}
                                    <span class="text-xs text-gray-400 float-right mt-0.5">
                                        {{ $conv->created_at->diffForHumans() }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>