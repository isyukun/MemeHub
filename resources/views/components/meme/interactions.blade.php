@props(['meme'])

<div>
    <div class="p-4 bg-white border-b border-gray-50 flex items-center space-x-6">
        <form action="{{ route('memes.like', $meme) }}" method="POST">
            @csrf
            @php $isLiked = $meme->isLikedByAuthUser(); @endphp
            <button class="group flex items-center space-x-2 {{ $isLiked ? 'text-rose-500' : 'text-gray-500 hover:text-rose-500' }} transition-all">
                <div class="p-2 rounded-full group-hover:bg-rose-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="{{ $isLiked ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <span class="font-bold text-sm">{{ $meme->likes()->count() }}</span>
            </button>
        </form>

        <button onclick="document.getElementById('comment-input-{{ $meme->id }}').focus()" class="group flex items-center space-x-2 text-gray-500 hover:text-indigo-500 transition-all">
            <div class="p-2 rounded-full group-hover:bg-indigo-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <span class="font-bold text-sm">{{ $meme->comments->count() }}</span>
        </button>
    </div>

    <div class="px-5 py-4 bg-gray-50/30">
        <div class="space-y-3 mb-4 max-h-48 overflow-y-auto custom-scrollbar">
            @foreach($meme->comments as $comment)
                <div class="flex items-start space-x-2">
                    <div class="bg-gray-100 rounded-2xl px-4 py-2 text-sm">
                        <span class="font-black text-gray-900 mr-1 text-xs">{{ $comment->user->name }}</span>
                        <span class="text-gray-700 leading-relaxed">{{ $comment->body }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('comments.store', $meme) }}" method="POST">
            @csrf
            <div class="relative">
                <input type="text" name="body" id="comment-input-{{ $meme->id }}" 
                       placeholder="Balas dengan sesuatu yang lebih lucu..." 
                       class="w-full pl-4 pr-12 py-2.5 bg-white border-none focus:ring-2 focus:ring-indigo-400 rounded-2xl text-sm transition-all shadow-inner outline-none">
                
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>