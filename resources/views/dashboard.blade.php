<x-app-layout>
    <header class="bg-white border-b border-gray-100 py-6">
        <div class="max-w-3xl mx-auto px-6">
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Feed Utama</h1>
            <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Temukan tawa hari ini</p>
        </div>
    </header>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if($trendingMemes->count() > 0)
            <div class="mb-10">
                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-4 ml-1">🔥 Sedang Trending</h3>
                <div class="flex space-x-4 overflow-x-auto pb-4 custom-scrollbar">
                    @foreach($trendingMemes as $trending)
                        <div class="min-w-[120px] h-[120px] rounded-2xl overflow-hidden border-2 border-white shadow-md hover:scale-105 transition duration-300">
                            <img src="{{ asset('storage/' . $trending->image_path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <x-meme.category-list :categories="$categories" />

            <x-meme.create-post-box :categories="$categories" />

            <div class="space-y-8 animate-fadeIn">
                @forelse($memes as $meme)
                    <div class="group">
                        <x-meme.card :meme="$meme" />
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                        <div class="text-6xl mb-4 grayscale hover:grayscale-0 transition cursor-pointer">🎭</div>
                        <p class="text-gray-400 font-black uppercase tracking-widest text-sm">
                            Gak ada meme di sini. <span class="text-indigo-600 underline">Upload meme pertamamu!</span>
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #F1F5F9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>