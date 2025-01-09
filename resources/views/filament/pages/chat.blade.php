<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}

        @if(!$waitingForResponse)
            <x-filament::button
                    class="mt-6"
                    type="submit"
                    wire:target="submit">
                Send Message
            </x-filament::button>
        @else
            <div class="mt-6">
                <p>Waiting for AI response...</p>
            </div>
        @endif

        @if($reply)
            <div class="mt-6">
                <p class="font-bold">Your question:</p>
                <p>{{ $lastQuestion }}</p>
                <p class="mt-6 font-bold">AI Response:</p>
                <p>{{ $reply }}</p>
            </div>
        @endif
    </form>
    <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Chatbot | JVCodes</title>
    <!-- Linking Google fonts for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="/css/chat/style.css" />
</head>
<body>
 <!-- Chatbot Toggler -->
    <button id="chatbot-toggler">
        <span class="material-symbols-rounded">mode_comment</span>
        <span class="material-symbols-rounded">close</span>
    </button>

    <!-- Chatbot Popup -->
    <div class="chatbot-popup">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="header-info">
                <img class="chatbot-logo" src="robotic.png" alt="Chatbot Logo" width="50" height="50">
                <h2 class="logo-text">Chatbot</h2>
            </div>
            <button id="close-chatbot" class="material-symbols-rounded">keyboard_arrow_down</button>
        </div>

        <!-- Chat Body -->
        <div class="chat-body">
            @foreach($messages as $message)
                <div class="message {{ $message['role'] === 'user' ? 'user-message' : 'bot-message' }}">
                    <div class="message-text">{{ $message['content'] }}</div>
                </div>
            @endforeach
        </div>

        <!-- Chat Footer -->
        <div class="chat-footer">
            <form wire:submit.prevent="sendMessage" class="chat-form">
                <textarea wire:model.defer="currentMessage"
                          placeholder="Type a message..."
                          class="message-input"
                          required></textarea>
                <div class="chat-controls">
                    <button type="submit" id="send-message" class="material-symbols-rounded">
                        arrow_upward
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const chatbotToggler = document.querySelector("#chatbot-toggler");
        const closeChatbot = document.querySelector("#close-chatbot");

        chatbotToggler.addEventListener("click", () => {
            document.body.classList.toggle("show-chatbot");
        });

        closeChatbot.addEventListener("click", () => {
            document.body.classList.remove("show-chatbot");
        });
    </script>
</body>
</html>
</x-filament-panels::page>
