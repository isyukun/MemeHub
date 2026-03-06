@props(['categories'])

<div class="bg-white rounded-2xl mb-8 shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-4 flex items-center space-x-4 border-b border-gray-50">
        <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold uppercase">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        
        <button onclick="document.getElementById('meme-upload-form').classList.toggle('hidden')" 
                class="flex-1 text-left bg-gray-100 hover:bg-gray-200 py-2.5 px-5 rounded-full text-gray-500 text-sm transition-all">
            Apa yang lucu hari ini, {{ explode(' ', auth()->user()->name)[0] }}?
        </button>
    </div>
    
    <div id="meme-upload-form" class="hidden p-6 bg-white border-t border-gray-50 animate-fadeIn">
        <form action="{{ route('memes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <input type="text" name="title" placeholder="Tulis caption kocak..." required
                       class="w-full border-none focus:ring-0 text-lg font-medium placeholder-gray-400">
                
                <div class="flex flex-wrap gap-3">
                    <select name="category" class="text-xs font-bold border-gray-200 rounded-full px-4 py-1.5 bg-gray-50 text-gray-600">
                        @foreach($categories as $cat)
                            <option value="{{ strtolower($cat) }}">{{ $cat }}</option>
                        @endforeach
                    </select>

                    <label class="flex items-center space-x-2 cursor-pointer bg-yellow-50 px-4 py-1.5 rounded-full border border-yellow-100">
                        <input type="checkbox" name="is_exclusive" class="rounded text-yellow-500 focus:ring-yellow-400 w-3 h-3">
                        <span class="text-[10px] font-black text-yellow-700 uppercase italic tracking-wider">Exclusive ✨</span>
                    </label>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <input type="file" name="image" id="img-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                    
                    <label for="img-input" class="flex items-center space-x-2 text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg cursor-pointer transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-bold uppercase">Foto</span>
                    </label>

                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-8 shadow-lg shadow-indigo-100">
                        Post!
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi sederhana untuk preview gambar (opsional)
    function previewImage(input) {
        if (input.files && input.files[0]) {
            console.log("File terpilih: " + input.files[0].name);
            // Kamu bisa tambahkan logika preview gambar di sini jika mau
        }
    }
</script>