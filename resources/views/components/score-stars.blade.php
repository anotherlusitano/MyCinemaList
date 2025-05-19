@props(['score'])

<div class="flex items-center mt-1 mb-3 ti">
    <!-- Stars -->
    <div class="text-yellow-500 mr-2">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= floor($score / 2))
                ★
            @elseif ($i - 0.5 <= $score / 2)
                ☆
            @else
                ☆
            @endif
        @endfor
    </div>
    <span class="text-gray-600">{{ number_format($score, 1) }}/10</span>
</div>
