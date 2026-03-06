@props(['meme'])

<article class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300">
    <div class="p-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-gray-100 to-gray-200 flex items-center justify-center font-black text-gray-400 text-xs shadow-inner uppercase">
                {{ substr($meme->user->name, 0, 1) }}
            </div>
            <div>
                <a href="{{ route('user.profile', $meme->user->name) }}" class="block text-xs font-black text-gray-900 hover:text-indigo-600 transition tracking-tight">
                    {{ $meme->user->name }}
                </a>
                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $meme->created_at->diffForHumans() }}</span>
            </div>
        </div>
        
        @if($meme->user_id === auth()->id())
            <form action="{{ route('memes.destroy', $meme) }}" method="POST" onsubmit="return confirm('Hapus meme ini?')">
                @csrf @method('DELETE')
                <button class="text-gray-300 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        @endif
    </div>

    <div class="relative bg-gray-50 overflow-hidden">
        <img src="{{ asset('storage/' . $meme->image_path) }}" 
             class="w-full h-auto block transition-transform duration-500 {{ $meme->is_exclusive && $meme->user_id !== auth()->id() ? 'blur-2xl brightness-50' : 'hover:scale-[1.02]' }}"
             loading="lazy"
             alt="{{ $meme->title }}">
        
        @if($meme->is_exclusive)
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-full shadow-lg">
                <span class="text-[9px] font-black italic tracking-widest text-indigo-600">✨ EXCLUSIVE</span>
            </div>
        @endif

        @if($meme->is_exclusive && $meme->user_id !== auth()->id())
            <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-white z-20">
                <div class="bg-black/40 backdrop-blur-xl p-4 rounded-2xl border border-white/10 text-center">
                    <p class="font-black uppercase text-[10px] tracking-widest">Konten Terkunci</p>
                </div>
            </div>
        @endif
    </div>

    <div class="px-5 py-4">
        <h3 class="text-sm font-medium text-gray-800 leading-snug mb-3">{{ $meme->title }}</h3>
        <x-meme.interactions :meme="$meme" />
    </div>
</article>