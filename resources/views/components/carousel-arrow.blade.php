@props([
    'direction' => 'right',
    'carouselClass'
])

<button
    onclick="scrollCarousel('{{ $carouselClass }}', '{{ $direction }}')"
    class="absolute top-1/2 transform -translate-y-1/2 {{ $direction === 'left' ? 'left-10' : 'right-0' }}
           w-12 h-12 bg-neutral-900/80 hover:bg-neutral-800 text-white
           flex items-center justify-center rounded-full shadow-md"
>
    @if($direction === 'left')
        <x-tabler-arrow-badge-left-filled/>
    @else
        <x-tabler-arrow-badge-right-filled/>
    @endif
</button>


<script>
    function scrollCarousel(carouselClass, direction) {
        const carousels = document.getElementsByClassName(carouselClass)[0];

        carousels.scrollBy({
            left: direction === 'left' ? -500 : 500,
            behavior: "smooth",
        });
    }
</script>
