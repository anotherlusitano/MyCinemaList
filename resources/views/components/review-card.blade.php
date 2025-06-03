@props(['review'])

@php
    use Carbon\Carbon;

    $date = Carbon::parse($review->created_at)->isoFormat('MMM D, YYYY');
    $isLongText = strlen($review->text) > 300;
    $shortText = Str::limit($review->text, 300, '...');
@endphp

<div
    x-data="{ expanded: false }"
    :style="expanded ? 'height: auto' : 'height: 350px'"
    class="w-full max-w-4xl mt-6 mx-auto rounded-xl border border-gray-200 shadow bg-white p-6 overflow-hidden transition-all duration-300"
>
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-4">
            <a href="/users/{{ $review->user->id }}">
                <img src="{{ $review->user->picture }}" alt="{{ $review->user->username }}"
                     class="w-16 h-16 rounded-lg object-cover text-xs"/>
            </a>
            <div>
                <a href="/users/{{ $review->user->id }}"
                   class="text-blue-600 font-semibold hover:underline">{{ $review->user->username }}</a>
                <div class="mt-1">
                    <x-recommendation-label :recommendation="$review->recommendation"/>
                </div>
            </div>
        </div>
        <span class="text-gray-500 text-sm">{{ $date }}</span>
    </div>

    <div class="mt-4 text-gray-800 text-base leading-relaxed">
        <template x-if="expanded">
            <p>{{ $review->text }}</p>
        </template>
        <template x-if="!expanded">
            <p>{{ $shortText }}</p>
        </template>
    </div>

    @if ($isLongText)
        <div class="mt-3 text-sm text-gray-500 cursor-pointer select-none">
            <button
                @click="expanded = !expanded"
                class="hover:underline"
                x-text="expanded ? '▲ Show Less' : '▼ Read More'"
            ></button>
        </div>
    @else
        <div class="mt-3 opacity-0 select-none">▼ Read More</div>
    @endif
</div>
