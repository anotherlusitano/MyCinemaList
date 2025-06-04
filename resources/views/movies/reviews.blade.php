<x-app-layout>
    @foreach($reviews as $review)
        <x-review-card :review="$review"/>
    @endforeach

    {{ $reviews->links() }}
</x-app-layout>
