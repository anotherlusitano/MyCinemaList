@props(['review', 'class' => ''])

@php
    use App\Models\UserMovieProgress;
    use Carbon\Carbon;

    $date = Carbon::parse($review->created_at)->isoFormat('MMM D, YYYY');
    $isLongText = strlen($review->text) > 300;
    $shortText = Str::limit($review->text, 300, '...');

    $user = Auth::user();

    $score = UserMovieProgress::where('user_id', $review->user_id)
        ->where('movie_id', $review->movie_id)
        ->value('score');
@endphp

<div
    x-data="{ expanded: false }"
    {{ $attributes->merge(['class' => "w-full max-w-4xl mt-6 rounded-xl border border-gray-200 shadow bg-white p-6 overflow-hidden transition-all duration-300 $class"]) }}
>
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-4">
            <a href="/users/{{ $review->user->id }}">
                <img src="{{ asset($review->user->picture) }}" alt="{{ $review->user->username }}"
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
        <div class="flex flex-col items-end gap-1">
            <span class="text-gray-500 text-sm">{{ $date }}</span>

            @if($user?->role === 'admin')
                <div x-data="{ showModal: false }"
                     @keydown.escape.window="showModal = false"
                >
                    <span href="#"
                          @click.prevent="showModal = true"
                          class="text-red-500 cursor-pointer">
                                <x-gmdi-delete class="w-6 h-6"/>
                            </span>

                    <x-delete-dialog :name="'review of ' . $review->user->username"
                                     :route="'/reviews/' . $review->id . '/destroy'"/>
                </div>
            @else
                <div></div>
            @endif
        </div>
    </div>

    <div class="mt-4 text-gray-800 text-base leading-relaxed">
        <template x-if="expanded">
            <p>{{ $review->text }}</p>
        </template>
        <template x-if="!expanded">
            <p>{{ $shortText }}</p>
        </template>
    </div>

    <div class="flex flex-row justify-between items-end">
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

        @if($score)
            <span class="text-gray-500 text-sm">Score given: {{ $score }}</span>
        @endif
    </div>
</div>
