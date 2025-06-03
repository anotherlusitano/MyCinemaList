@props(['recommendation'])

<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-purple-100">
    @if ($recommendation === 'recommended')
        <x-uiw-like-o class="w-6 h-6 text-blue-600"/>
        <span class="text-sm font-semibold text-blue-600">Recommended</span>
    @elseif ($recommendation === 'mixed feelings')
        <x-gmdi-sentiment-neutral-r class="w-6 h-6 text-gray-600"/>
        <span class="text-sm font-semibold text-gray-600">Mixed Feelings</span>
    @elseif ($recommendation === 'not recommended')
        <x-uiw-dislike-o class="w-6 h-6 text-red-600"/>
        <span class="text-sm font-semibold text-red-600">Not Recommended</span>
    @endif
</div>
