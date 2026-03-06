<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-gray-900 leading-tight uppercase tracking-tighter">
                {{ __('Control Center') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-[10px] font-black text-gray-400 hover:text-indigo-600 uppercase tracking-widest transition">
                ← Kembali ke Feed
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Profil</h3>
                    <p class="text-sm text-gray-900 mt-2 font-bold">Identitas publik Anda</p>
                </div>
                <div class="md:col-span-2 p-8 bg-white shadow-sm rounded-3xl border border-gray-100">
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')
                        
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" class="text-[10px] font-black uppercase tracking-widest text-gray-400" />
                            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full bg-gray-50 border-gray-100 rounded-2xl focus:border-indigo-500 focus:ring-0" :value="old('name', $user->name)" required />
                        </div>
                        <div>
                            <x-input-label for="email" value="Alamat Email" class="text-[10px] font-black uppercase tracking-widest text-gray-400" />
                            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full bg-gray-50 border-gray-100 rounded-2xl focus:border-indigo-500 focus:ring-0" :value="old('email', $user->email)" required />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 rounded-2xl px-8 py-3 font-black uppercase tracking-widest text-xs">{{ __('Simpan Perubahan') }}</x-primary-button>
                            @if (session('status') === 'profile-updated')
                                <p class="text-xs text-green-600 font-black uppercase">✓ Tersimpan</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start pt-8 border-t border-gray-200">
                <div>
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Keamanan</h3>
                    <p class="text-sm text-gray-900 mt-2 font-bold">Jaga akses akun Anda</p>
                </div>
                <div class="md:col-span-2 p-8 bg-white shadow-sm rounded-3xl border border-gray-100">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf @method('put')
                        <div>
                            <x-input-label for="current_password" value="Sandi Lama" class="text-[10px] font-black uppercase tracking-widest text-gray-400" />
                            <x-text-input id="current_password" name="current_password" type="password" class="mt-2 block w-full bg-gray-50 border-gray-100 rounded-2xl focus:border-indigo-500 focus:ring-0" />
                        </div>
                        <div>
                            <x-input-label for="password" value="Sandi Baru" class="text-[10px] font-black uppercase tracking-widest text-gray-400" />
                            <x-text-input id="password" name="password" type="password" class="mt-2 block w-full bg-gray-50 border-gray-100 rounded-2xl focus:border-indigo-500 focus:ring-0" />
                        </div>
                        <x-primary-button class="bg-gray-900 hover:bg-black rounded-2xl px-8 py-3 font-black uppercase tracking-widest text-xs">{{ __('Update Sandi') }}</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-200">
                <div class="p-8 bg-red-50/50 border-2 border-red-100 rounded-3xl">
                    <h3 class="font-black text-red-600 uppercase tracking-widest text-sm">Danger Zone</h3>
                    <p class="text-sm text-red-800 mt-2 font-medium mb-6">Sekali akun dihapus, tidak bisa kembali. Pikirkan baik-baik!</p>
                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="rounded-2xl px-8 py-3 uppercase font-black tracking-widest text-xs">
                        {{ __('Hapus Akun Permanen') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>