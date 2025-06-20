@php
    $user = Auth::user();
@endphp

<div x-data="{ open: false }" class="relative">
    <!-- Profile Picture -->
    <img
        @click="open = !open"
        src="{{ asset($user->picture) ?? asset('person.png') }}"
        alt="Profile"
        class="w-12 h-12 rounded-full object-cover border border-black cursor-pointer"
    >

    <!-- Dropdown -->
    <div
        x-show="open"
        @click.away="open = false"
        x-transition
        class="absolute right-0 mt-2 w-48 rounded-2xl bg-gray-100 text-black shadow-lg z-50 p-4 space-y-4"
    >
        @if($user->role === 'admin')
            <a href="/backoffice" class="flex items-center text-lg space-x-2 hover:underline">
                <x-tabler-brand-office class="w-5 h-5"/>
                <span>Backoffice</span>
            </a>
        @else
            <a href="/users/{{ $user->id }}" class="flex items-center text-lg space-x-2 hover:underline">
                <x-bi-person-fill class="w-5 h-5"/>
                <span>Profile</span>
            </a>
            <a href="/users/{{ $user->id }}/reviews" class="flex items-center text-lg space-x-2 hover:underline">
                <x-gmdi-rate-review-o class="w-5 h-5"/>
                <span>Reviews</span>
            </a>
            <a href="#" class="flex items-center text-lg space-x-2 hover:underline">
                <x-uiw-setting class="w-5 h-5"/>
                <span>Settings</span>
            </a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center text-lg space-x-2 hover:underline w-full text-left">
                <x-tabler-logout class="w-5 h-5"/>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
