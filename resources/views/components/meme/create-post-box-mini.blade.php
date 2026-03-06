<div x-data="{ open: false }">
    <button @click="open = true" 
        class="group flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-full font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg">
        <span>+ Buat Meme</span>
    </button>

    <template x-teleport="body">
        <div x-show="open" 
            class="fixed inset-0 z-[999999] flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            x-cloak
            @keydown.escape.window="open = false">
            
            <div @click.away="open = false" 
                class="w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl relative animate-in zoom-in-95 duration-200">
                
                <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-900 font-bold">✕</button>
                
                <h3 class="font-black text-lg uppercase tracking-tighter mb-6">Tambah Meme Baru</h3>

                <form action="{{ route('memes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Judul meme..." required class="w-full p-4 bg-gray-50 rounded-2xl border-none">
                    
                    <select name="category" required class="w-full p-4 bg-gray-50 rounded-2xl border-none text-gray-500">
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="funny">Funny</option>
                        <option value="dark">Dark</option>
                        <option value="wholesome">Wholesome</option>
                        <option value="savage">Savage</option>
                    </select>
                    
                    <input type="file" name="image" required class="w-full text-sm text-gray-500">
                    
                    <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-black uppercase tracking-widest text-xs rounded-2xl hover:bg-indigo-700 transition">
                        Unggah Sekarang 🚀
                    </button>
                </form>
            </div>
        </div>
    </template>
</div>