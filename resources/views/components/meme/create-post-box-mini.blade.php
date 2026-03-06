<div x-data="{ open: false }">
    <button @click="open = true" 
        class="group flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-full font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg">
        <span>+ Buat Meme</span>
    </button>

    <div x-show="open" 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        x-cloak>
        
        <div @click.away="open = false" 
            class="w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl relative">
            
            <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 font-bold">✕</button>
            
            <h3 class="font-black text-lg uppercase tracking-tighter mb-6">Tambah Meme Baru</h3>

            <form action="{{ route('memes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="text" name="title" placeholder="Judul meme..." required
                    class="w-full p-4 bg-gray-50 rounded-2xl border-none focus:ring-2 focus:ring-indigo-500">
                
                <input type="file" name="image" required
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700">
                
                <button type="submit" 
                    class="w-full py-4 bg-indigo-600 text-white font-black uppercase tracking-widest text-xs rounded-2xl hover:bg-indigo-700 transition">
                    Unggah Sekarang 🚀
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>