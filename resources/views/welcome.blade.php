<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MemeHub - Share the Laughs</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body { font-family: 'Figtree', sans-serif; }
            .bg-pattern {
                background-color: #f3f4f6;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased bg-pattern">
        <nav class="p-6 flex justify-between items-center max-w-7xl mx-auto">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <span class="text-white text-2xl font-black">M</span>
                </div>
                <span class="text-2xl font-black tracking-tighter text-gray-900 uppercase">MemeHub</span>
            </div>

            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-bold text-gray-700 hover:text-indigo-600 transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform hover:scale-105 inline-block">Join Now</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        <main class="max-w-7xl mx-auto px-6 pt-16 pb-24 flex flex-col items-center text-center">
            <section class="max-w-7xl mx-auto px-6 py-24">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter uppercase">Intip Tawa Minggu Ini</h2>
                    <p class="text-gray-500 font-medium">Jangan cuma ngintip, join biar bisa ikutan komen!</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @isset($trendingMemes)
                        @foreach($trendingMemes as $meme)
                            <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition group">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-fuchsia-500 flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($meme->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-gray-900">{{ $meme->user->name }}</p>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-black">{{ $meme->category }}</p>
                                    </div>
                                </div>
                                
                                <div class="aspect-square bg-gray-50 rounded-2xl mb-4 overflow-hidden border border-gray-50 relative">
                                    <img src="{{ asset('storage/' . $meme->image_path) }}" class="object-cover w-full h-full group-hover:scale-105 transition duration-500">
                                    
                                    @if($meme->is_exclusive)
                                        <div class="absolute top-3 right-3 bg-black/50 backdrop-blur-md text-white px-3 py-1 rounded-full text-[10px] font-bold">
                                            🔒 EXCLUSIVE
                                        </div>
                                    @endif
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xl">🔥</span>
                                        <span class="font-black text-gray-900">{{ $meme->likes_count }}</span>
                                    </div>
                                    <a href="{{ route('login') }}" class="text-xs font-black text-indigo-600 uppercase tracking-wider hover:underline">
                                        Lihat Komentar →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-3 text-center py-20 border-2 border-dashed border-gray-200 rounded-3xl">
                            <p class="text-gray-400 font-medium italic">Belum ada meme yang nangkring di sini...</p>
                        </div>
                    @endisset
                </div>

                <div class="mt-16 text-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 font-black text-gray-900 hover:text-indigo-600 transition">
                        <span>LIHAT SEMUA MEME</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </section>
        </main>

        <footer class="py-12 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
                <p>&copy; 2026 MemeHub Internasional. Dibuat dengan tenaga batin dan Laravel v{{ Illuminate\Foundation\Application::VERSION }}.</p>
                <div class="flex space-x-6 mt-4 md:mt-0 font-bold uppercase tracking-widest text-[10px]">
                    <a href="#" class="hover:text-indigo-600">Privacy</a>
                    <a href="#" class="hover:text-indigo-600">Terms</a>
                    <a href="#" class="hover:text-indigo-600">Contact</a>
                </div>
            </div>
        </footer>
    </body>
</html>