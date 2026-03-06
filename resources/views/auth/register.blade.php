<x-guest-layout>
    <div class="mb-10 text-center relative">
        <div class="absolute -top-4 -right-4 w-12 h-12 bg-fuchsia-100 rounded-full blur-2xl opacity-50"></div>
        
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-fuchsia-600 to-indigo-600 rounded-2xl shadow-xl shadow-fuchsia-200 mb-6 transform rotate-3 transition hover:rotate-0 duration-300">
            <span class="text-white text-3xl font-black">M+</span>
        </div>
        
        <h2 class="text-4xl font-black text-gray-900 tracking-tighter uppercase leading-none">
            Join <span class="text-fuchsia-600">MemeHub!</span>
        </h2>
        <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-3">Mulai Perjalanan Komedimu</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-black text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1 ml-1">Nama Panggung / Username</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-fuchsia-600 transition">
                    👤
                </div>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                    class="block w-full pl-11 pr-4 py-3 bg-gray-50 border-2 border-gray-100 focus:border-fuchsia-500 focus:ring-0 rounded-2xl text-gray-900 font-semibold transition placeholder:text-gray-300 shadow-sm"
                    placeholder="Contoh: Budi Tertawa" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <label for="email" class="block font-black text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1 ml-1">Alamat Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-fuchsia-600 transition">
                    📧
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required 
                    class="block w-full pl-11 pr-4 py-3 bg-gray-50 border-2 border-gray-100 focus:border-fuchsia-500 focus:ring-0 rounded-2xl text-gray-900 font-semibold transition placeholder:text-gray-300 shadow-sm"
                    placeholder="email@memehub.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block font-black text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1 ml-1">Kata Sandi</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 focus:border-fuchsia-500 focus:ring-0 rounded-2xl text-gray-900 font-semibold transition placeholder:text-gray-300 shadow-sm"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
            </div>

            <div>
                <label for="password_confirmation" class="block font-black text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1 ml-1">Ulangi Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required 
                    class="block w-full px-4 py-3 bg-gray-50 border-2 border-gray-100 focus:border-fuchsia-500 focus:ring-0 rounded-2xl text-gray-900 font-semibold transition placeholder:text-gray-300 shadow-sm"
                    placeholder="••••••••" />
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="group relative w-full flex justify-center py-4 bg-fuchsia-600 hover:bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-fuchsia-100 transition-all duration-300 transform hover:-translate-y-1 active:scale-95 overflow-hidden">
                <span class="relative z-10">{{ __('Daftar Sekarang ✨') }}</span>
                <div class="absolute inset-0 bg-gradient-to-r from-fuchsia-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">
                Sudah Jadi Member? 
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-fuchsia-600 transition decoration-2 underline-offset-4">Masuk Sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>