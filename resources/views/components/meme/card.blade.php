@props(['meme'])

<article class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md">
    <div class="p-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-gray-200 to-gray-300 flex items-center justify-center font-black text-gray-500 shadow-inner uppercase">
                {{ substr($meme->user->name, 0, 1) }}
            </div>
            <div>
                <a href="{{ route('user.profile', $meme->user->name) }}" class="block text-sm font-black text-gray-900 hover:text-indigo-600 transition tracking-tight">
                    {{ $meme->user->name }}
                </a>
                <div class="flex items-center space-x-2">
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $meme->created_at->diffForHumans() }}</span>
                    <span class="text-gray-300">•</span>
                    <span class="text-[10px] font-black text-indigo-500 uppercase italic">{{ $meme->category }}</span>
                </div>
            </div>
        </div>
        
        @if($meme->user_id === auth()->id())
            <form action="{{ route('memes.destroy', $meme) }}" method="POST" onsubmit="return confirm('Hapus meme ini?')">
                @csrf @method('DELETE')
                <button class="text-gray-300 hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        @endif
    </div>

    <div class="px-5 pb-3">
        <h3 class="text-base font-medium text-gray-800 tracking-tight leading-relaxed">{{ $meme->title }}</h3>
    </div>

    <div class="bg-black/5 relative group">
        <img src="{{ asset('storage/' . $meme->image_path) }}" 
             class="w-full h-auto max-h-[600px] object-contain block mx-auto {{ $meme->is_exclusive && $meme->user_id !== auth()->id() ? 'blur-3xl brightness-50' : '' }}"
             loading="lazy">
        
        @if($meme->is_exclusive)
            <div class="absolute top-4 right-4 bg-yellow-400/90 backdrop-blur px-3 py-1.5 rounded-full shadow-lg z-10">
                <span class="text-[10px] font-black italic tracking-widest text-black flex items-center">
                    <span class="mr-1">✨</span> GOLD EXCLUSIVE
                </span>
            </div>
        @endif

        @if($meme->is_exclusive && $meme->user_id !== auth()->id())
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-white z-20">
                <div class="bg-black/60 backdrop-blur-xl p-8 rounded-3xl border border-white/20 shadow-2xl scale-90 md:scale-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <p class="font-black uppercase tracking-widest text-lg">Konten Eksklusif</p>
                    <p class="text-xs opacity-70 mt-2 font-medium">Follow <span class="underline">{{ $meme->user->name }}</span> untuk melihat</p>
                </div>
            </div>
        @endif
    </div>

    <x-meme.interactions :meme="$meme" />
</article>