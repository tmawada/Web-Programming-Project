<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyber-primary leading-tight">
            Chat with {{ $friend->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cyber-alt shadow-lg sm:rounded-lg border border-cyber-secondary/30 flex flex-col h-[600px]">
                
                <!-- Messages Area -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4" id="chat-messages">
                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs md:max-w-md p-3 rounded-lg {{ $msg->sender_id === auth()->id() ? 'bg-cyber-primary text-white' : 'bg-cyber-bg border border-cyber-secondary/30 text-gray-200' }}">
                                <p>{{ $msg->content }}</p>
                                <span class="text-xs opacity-70 block mt-1 text-right">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Input Area -->
                <div class="p-4 bg-cyber-bg border-t border-cyber-secondary/30">
                    <form action="{{ route('chat.store', $friend->id) }}" method="POST" class="flex gap-4">
                        @csrf
                        <input type="text" name="content" placeholder="Type a message..." autocomplete="off"
                            class="flex-1 bg-cyber-alt border border-cyber-secondary text-cyber-text rounded-md focus:ring-cyber-primary focus:border-cyber-primary">
                        <button type="submit" class="bg-cyber-primary text-white px-6 py-2 rounded-md hover:bg-cyber-secondary transition">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Scroll to bottom of chat
        const chatContainer = document.getElementById('chat-messages');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
</x-app-layout>
