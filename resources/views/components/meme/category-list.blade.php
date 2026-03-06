@props(['categories'])

<div class="flex space-x-4 overflow-x-auto pb-6 custom-scrollbar scroll-smooth">
    <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex flex-col items-center space-y-1 group">
        <div class="w-16 h-16 rounded-full p-1 {{ !request('category') ? 'bg-gradient-to-tr from-yellow-400 to-fuchsia-600' : 'bg-gray-200' }} ring-2 ring-white shadow-md transition-all group-hover:scale-105">
            <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xl">
                🏠
            </div>
        </div>
        <span class="text-[10px] font-bold uppercase tracking-tighter {{ !request('category') ? 'text-gray-900' : 'text-gray-500' }}">All</span>
    </a>

    @foreach($categories as $cat)
        @php
            $slug = strtolower($cat);
            $isActive = request('category') == $slug;
        @endphp
        
        <a href="{{ route('dashboard', ['category' => $slug]) }}" class="flex-shrink-0 flex flex-col items-center space-y-1 group">
            <div class="w-16 h-16 rounded-full p-1 {{ $isActive ? 'bg-gradient-to-tr from-blue-400 to-indigo-600' : 'bg-gray-200' }} ring-2 ring-white shadow-sm transition-all group-hover:scale-105">
                <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-lg uppercase font-black {{ $isActive ? 'text-indigo-600' : 'text-gray-400' }}">
                    {{ substr($cat, 0, 1) }}
                </div>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-tighter {{ $isActive ? 'text-indigo-600' : 'text-gray-500' }}">
                {{ $cat }}
            </span>
        </a>
    @endforeach
</div>