<x-app-layout>
    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-xl font-black text-gray-900 uppercase tracking-tighter">MemeHub Feed</h1>
            <x-meme.create-post-box-mini /> 
        </div>
    </header>

    <div class="py-6 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            
            <div class="flex gap-2 overflow-x-auto pb-6 mb-4 custom-scrollbar">
                @foreach($categories as $category)
                    <a href="{{ route('dashboard', ['category' => $category]) }}" 
                       class="px-5 py-2 bg-white rounded-full font-bold text-xs uppercase tracking-widest text-gray-600 border hover:border-indigo-500 hover:text-indigo-600 transition shadow-sm whitespace-nowrap">
                        {{ ucfirst($category) }}
                    </a>
                @endforeach
            </div>

            <div class="masonry-grid">
                @forelse($memes as $meme)
                    <div class="masonry-item">
                        <x-meme.card :meme="$meme" />
                    </div>
                @empty
                    <div class="py-20 text-center col-span-full">
                        <p class="text-gray-400 font-bold uppercase tracking-widest">Belum ada meme, jadilah yang pertama!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .masonry-grid {
            column-count: 2;
            column-gap: 1.5rem;
            width: 100%;
        }
        @media (min-width: 768px) { .masonry-grid { column-count: 3; } }
        @media (min-width: 1024px) { .masonry-grid { column-count: 4; } }
        
        .masonry-item {
            display: inline-block;
            width: 100%;
            margin-bottom: 1.5rem;
            break-inside: avoid;
            /* Tambahkan ini agar ada animasi masuk */
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .custom-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</x-app-layout>