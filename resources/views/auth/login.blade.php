<x-guest-layout>
    <div class="mb-10 text-center relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-indigo-100 rounded-full blur-2xl opacity-50"></div>
        <div class="absolute -bottom-4 -right-4 w-12 h-12 bg-fuchsia-100 rounded-full blur-2xl opacity-50"></div>
        
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-indigo-600 to-fuchsia-600 rounded-2xl shadow-xl shadow-indigo-200 mb-6 transform -rotate-3 transition hover:rotate-0 duration-300">
            <span class="text-white text-3xl font-black">M</span>
        </div>
        
        <h2 class="text-4xl font-black text-gray-900 tracking-tighter uppercase leading-none">
            Welcome <span class="text-indigo-600">Back!</span>
        </h2>
        <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-3">Markas Besar MemeHub</p>
    </div>

    <x-auth-session-status class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl text-sm font-bold" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block font-black text-[10px] uppercase tracking-[0.2em] text-gray-400 mb-1 ml-1">Alamat Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition">
                    📧
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 rounded-2xl text-gray-900 font-semibold transition placeholder:text-gray-300 shadow-sm"
                    placeholder="nama@keren.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-1 ml-1">
                <label for="password" class="block font-black text-[10px] uppercase tracking-[0.2em] text-gray-400">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black uppercase tracking-widest text-indigo-500 hover:text-fuchsia-500 transition" href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600 transition">
                    🔑
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 rounded-2xl text-gray-900 font-semibold transition placeholder:text-gray-300 shadow-sm"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-lg border-2 border-gray-200 text-indigo-600 shadow-sm focus:ring-0 w-5 h-5 transition cursor-pointer" name="remember">
                <span class="ms-3 text-xs text-gray-500 font-black uppercase tracking-tighter group-hover:text-gray-700">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="group relative w-full flex justify-center py-4 bg-gray-900 hover:bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 overflow-hidden">
                <span class="relative z-10">{{ __('Masuk Ke Markas 🚀') }}</span>
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-fuchsia-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>
        </div>

        <div class="text-center mt-8">
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">
                Belum Jadi Member? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-fuchsia-600 transition decoration-2 underline-offset-4">Join Sekarang</a>
            </p>
        </div>
    </form>
</x-guest-layout>