@props(['reviews'])

@php
    $totalRecommendations = $reviews->count();

    $notRecommendedCount = $reviews->where('recommendation', 'not recommended')->count();
    $recommendedCount = $reviews->where('recommendation', 'recommended')->count();
    $mixedFeelingsCount = $reviews->where('recommendation', 'mixed feelings')->count();

    $notRecommendedPercentage = $totalRecommendations > 0 ? ($notRecommendedCount / $totalRecommendations) * 100 : 0;
    $recommendedPercentage = $totalRecommendations > 0 ? ($recommendedCount / $totalRecommendations) * 100 : 0;
    $mixedFeelingsPercentage = $totalRecommendations > 0 ? ($mixedFeelingsCount / $totalRecommendations) * 100 : 0;
@endphp

<div class="flex h-4 overflow-hidden rounded bg-gray-100">
    <div class="bg-blue-600" style="width: {{ $recommendedPercentage }}%"></div>
    <div class="bg-gray-400" style="width: {{ $mixedFeelingsPercentage }}%"></div>
    <div class="bg-red-600" style="width: {{ $notRecommendedPercentage }}%"></div>
</div>
