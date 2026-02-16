<div x-data="{
    open: false,
    messages: [],
    userInput: '',
    loading: false,
    async sendMessage() {
        if(!this.userInput.trim() || this.loading) return;

        // 1. Grab API Key from the Meta Tag in Layout
        const apiKeyMeta = document.querySelector('meta[name=&quot;gemini-api-key&quot;]');
        const apiKey = apiKeyMeta ? apiKeyMeta.content : '';

        if(!apiKey) {
            this.messages.push({sender: 'System', text: 'Error: API Key not found in meta tags.'});
            return;
        }

        const prompt = this.userInput;
        this.messages.push({sender: 'You', text: prompt});
        this.userInput = '';
        this.loading = true;

        // Auto-scroll after user sends message
        this.$nextTick(() => { this.scrollToBottom(); });

        try {
            // 2. Call Gemini API
            const response = await fetch(`https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=${apiKey}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    contents: [{ parts: [{ text: prompt }] }]
                })
            });

            const data = await response.json();

            if (data.error) {
                this.messages.push({sender: 'AI', text: 'Google Error: ' + data.error.message});
            } else {
                const aiText = data.candidates[0].content.parts[0].text;
                this.messages.push({sender: 'AI', text: aiText});
            }
        } catch (err) {
            this.messages.push({sender: 'AI', text: 'Network Error: Check your connection.'});
            console.error(err);
        } finally {
            this.loading = false;
            // Auto-scroll after AI responds
            this.$nextTick(() => { this.scrollToBottom(); });
        }
    },
    scrollToBottom() {
        const container = this.$refs.chatBox;
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    }
}"
x-show="open"
x-cloak
@toggle-chat.window="open = !open"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 scale-90 translate-y-10"
x-transition:enter-end="opacity-100 scale-100 translate-y-0"
style="display: none;"
class="fixed bottom-32 right-6 bg-white border border-gray-300 rounded-lg shadow-2xl w-80 z-[10000] flex flex-col">

    <div class="flex items-center justify-between p-3 border-b bg-laravel text-white rounded-t-lg">
        <div class="flex items-center">
            <i class="fa-solid fa-robot mr-2"></i>
            <span class="font-bold">LaraGigs AI</span>
        </div>
        <button @click="open = false" class="text-white hover:text-black transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div x-ref="chatBox" class="flex-1 p-3 overflow-y-auto text-sm bg-gray-50 scroll-smooth" style="height: 300px;">
        <div class="text-center text-gray-400 text-[10px] mb-4 uppercase tracking-widest">Start a conversation</div>

        <template x-for="(msg, index) in messages" :key="index">
            <div class="mb-3">
                <div :class="msg.sender === 'You' ? 'text-right' : 'text-left'">
                    <span :class="msg.sender === 'You' ? 'bg-laravel text-white' : 'bg-white border border-gray-200 text-gray-800'"
                          class="inline-block px-3 py-2 rounded-lg shadow-sm max-w-[90%] break-words">
                        <strong class="block text-[9px] uppercase opacity-70 mb-1" x-text="msg.sender"></strong>
                        <span x-text="msg.text"></span>
                    </span>
                </div>
            </div>
        </template>

        <div x-show="loading" class="flex items-center text-gray-400 text-xs">
            <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Thinking...
        </div>
    </div>

    <form @submit.prevent="sendMessage" class="flex p-3 border-t bg-white rounded-b-lg">
        <input x-model="userInput" type="text"
               class="flex-1 border rounded-l-lg px-2 py-2 text-sm focus:outline-none focus:border-laravel focus:ring-1 focus:ring-laravel"
               placeholder="Type a message..." autocomplete="off" />
        <button type="submit"
                :disabled="loading"
                :class="loading ? 'bg-gray-400' : 'bg-laravel hover:bg-black'"
                class="text-white px-4 py-2 rounded-r-lg transition-colors">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>
</div>
