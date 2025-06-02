@props(['movieProgressList'])

@php
    // ------ Chart variables ------
    $total = $movieProgressList->count();

    $droppedCount = $movieProgressList->where('watch_status', 'dropped')->count();
    $completedCount = $movieProgressList->where('watch_status', 'completed')->count();
    $planToWatchCount = $movieProgressList->where('watch_status', 'plan-to-watch')->count();

    $droppedPercentage = $total > 0 ? ($droppedCount / $total) * 100 : 0;
    $completedPercentage = $total > 0 ? ($completedCount / $total) * 100 : 0;
    $planToWatchPercentage = $total > 0 ? ($planToWatchCount / $total) * 100 : 0;

    // ------ Score variables ------
    $averageScore = $movieProgressList->whereNotNull('score')->avg('score') ?? 0;
    $averageScore = round($averageScore, 2);
@endphp

{{-- Score --}}
<div class="w-80 text-sm text-gray-700">
    <span>Mean score:  <b>{{ $averageScore }}</b></span>
</div>

{{-- Chart with the movies progress --}}
<div class="flex h-8 w-80 overflow-hidden rounded bg-gray-100">
    <div class="bg-blue-900" style="width: {{ $completedPercentage }}%"></div>
    <div class="bg-red-700" style="width: {{ $droppedPercentage }}%"></div>
    <div class="bg-gray-300" style="width: {{ $planToWatchPercentage }}%"></div>
</div>

<div class="flex w-52 items-center justify-between space-x-2 mt-1">
    <div class="flex flex-row items-center">
        <div class="w-3 h-3 rounded-full bg-blue-900 mr-2"></div>
        <span class="text-sm font-medium">Completed</span>
    </div>
    <span class="ml-auto text-sm text-gray-500">{{ $completedCount }}</span>
</div>

<div class="flex w-52 items-center justify-between space-x-2 mt-1">
    <div class="flex flex-row items-center">
        <div class="w-3 h-3 rounded-full bg-red-700 mr-2"></div>
        <span class="text-sm font-medium">Dropped</span>
    </div>
    <span class="ml-auto text-sm text-gray-500">{{ $droppedCount }}</span>
</div>

<div class="flex w-52 items-center justify-between space-x-2 mt-1">
    <div class="flex flex-row items-center">
        <div class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
        <span class="text-sm font-medium">Plan to Watch</span>
    </div>
    <span class="ml-auto text-sm text-gray-500">{{ $planToWatchCount }}</span>
</div>
