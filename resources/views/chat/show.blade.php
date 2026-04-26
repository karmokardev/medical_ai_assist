<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="{{ route('chat.index') }}" class="text-sm text-blue-600 hover:underline">← Back</a>
                <span class="text-gray-400">/</span>
                <h2 class="font-semibold text-gray-800">💬 AI Chat</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-3xl px-4 mx-auto">
            <div class="overflow-hidden bg-white shadow rounded-2xl">

                {{-- Chat Messages --}}
                <div id="chat-box" class="h-[500px] overflow-y-auto p-6 space-y-4">

                    {{-- Welcome message --}}
                    @if($messages->count() === 0)
                        <div class="mt-20 text-center text-gray-400">
                            <div class="mb-3 text-5xl">👨‍⚕️</div>
                            <p>আপনার symptoms বলুন, আমি সাহায্য করব</p>
                        </div>
                    @endif

                    {{-- Previous messages --}}
                    @foreach($messages as $msg)
                        @if($msg->role === 'user')
                            {{-- User message --}}
                            <div class="flex justify-end">
                                <div class="bg-blue-600 text-white rounded-2xl rounded-tr-sm px-4 py-3 max-w-[80%]">
                                    {{ $msg->content }}
                                </div>
                            </div>
                        @else
                            {{-- AI message --}}
                            <div class="flex justify-start">
                                <div class="max-w-[85%]">
                                    <div class="px-4 py-3 bg-gray-100 rounded-tl-sm rounded-2xl">
                                        <p class="text-sm text-gray-800 whitespace-pre-wrap">{{ $msg->content }}</p>
                                    </div>

                                    {{-- Medicine Cards --}}
                                    @if($msg->medicines && count($msg->medicines) > 0)
                                        <div class="mt-2 space-y-2">
                                            @foreach($msg->medicines as $med)
                                                <div class="px-4 py-3 border border-green-200 bg-green-50 rounded-xl">
                                                    <div class="flex items-start justify-between">
                                                        <div>
                                                            <p class="font-semibold text-green-800">💊 {{ $med['name'] }}</p>
                                                            <p class="text-xs text-green-600">{{ $med['generic_name'] }} • {{ $med['strength'] }}</p>
                                                            <p class="mt-1 text-xs text-gray-500">{{ $med['description'] }}</p>
                                                        </div>
                                                        <span class="ml-2 text-sm font-bold text-green-700">৳{{ $med['price'] }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Input Box --}}
                <div class="p-4 border-t">
                    <div class="flex gap-2" id="chat-form">
                        <input
                            type="text"
                            id="message-input"
                            placeholder="আপনার symptoms লিখুন... (যেমন: মাথাব্যথা, জ্বর)"
                            class="flex-1 text-sm border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                        />
                        <button
                            id="send-btn"
                            class="px-5 py-2 text-white bg-blue-600 rounded-xl hover:bg-blue-700 disabled:opacity-50"
                        >
                            Send
                        </button>
                    </div>
                    <p class="mt-2 text-xs text-center text-gray-400">
                        ⚠️ এটি professional medical advice নয়। জরুরি অবস্থায় ডাক্তার দেখান।
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Chat Script --}}
    <script>
        const chatBox = document.getElementById('chat-box');
        const input = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');

        // Scroll to bottom
        chatBox.scrollTop = chatBox.scrollHeight;

        function addUserMessage(text) {
            chatBox.innerHTML += `
                <div class="flex justify-end">
                    <div class="bg-blue-600 text-white rounded-2xl rounded-tr-sm px-4 py-3 max-w-[80%]">
                        ${text}
                    </div>
                </div>`;
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addAIMessage(text, medicines) {
            let medicineHtml = '';
            if (medicines && medicines.length > 0) {
                medicineHtml = medicines.map(med => `
                    <div class="px-4 py-3 mt-2 border border-green-200 bg-green-50 rounded-xl">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-semibold text-green-800">💊 ${med.name}</p>
                                <p class="text-xs text-green-600">${med.generic_name} • ${med.strength}</p>
                                <p class="mt-1 text-xs text-gray-500">${med.description}</p>
                            </div>
                            <span class="ml-2 text-sm font-bold text-green-700">৳${med.price}</span>
                        </div>
                    </div>`).join('');
            }

            chatBox.innerHTML += `
                <div class="flex justify-start">
                    <div class="max-w-[85%]">
                        <div class="px-4 py-3 bg-gray-100 rounded-tl-sm rounded-2xl">
                            <p class="text-sm text-gray-800 whitespace-pre-wrap">${text}</p>
                        </div>
                        ${medicineHtml}
                    </div>
                </div>`;
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addLoadingMessage() {
            chatBox.innerHTML += `
                <div id="loading" class="flex justify-start">
                    <div class="px-4 py-3 bg-gray-100 rounded-2xl">
                        <div class="flex gap-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0.2s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0.4s"></div>
                        </div>
                    </div>
                </div>`;
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        async function sendMessage() {
            const message = input.value.trim();
            if (!message) return;

            input.value = '';
            sendBtn.disabled = true;
            addUserMessage(message);
            addLoadingMessage();

            try {
                const response = await fetch('{{ route('chat.message', $conversation) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message })
                });

                const data = await response.json();
                document.getElementById('loading')?.remove();
                addAIMessage(data.message, data.medicines);

            } catch (error) {
                document.getElementById('loading')?.remove();
                addAIMessage('দুঃখিত, কিছু একটা সমস্যা হয়েছে। আবার চেষ্টা করুন।', []);
            }

            sendBtn.disabled = false;
            input.focus();
        }

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    </script>
</x-app-layout>