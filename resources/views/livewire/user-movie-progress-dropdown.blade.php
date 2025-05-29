<div class="flex gap-2 items-center">
    <div>
        <select
            wire:model="watch_status"
            wire:change="save('watch_status', $event.target.value)"
            class="border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="completed">Completed</option>
            <option value="dropped">Dropped</option>
            <option value="plan-to-watch">Plan to Watch</option>
        </select>
    </div>

    <div>
        <select
            wire:model="score"
            wire:change="save('score', $event.target.value)"
            class="border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
            <option value="">Select score</option>
            <option value="10">(10) Masterpiece ⭐</option>
            <option value="9">(9) Great</option>
            <option value="8">(8) Very Good</option>
            <option value="7">(7) Good</option>
            <option value="6">(6) Fine</option>
            <option value="5">(5) Average</option>
            <option value="4">(4) Bad</option>
            <option value="3">(3) Very Bad</option>
            <option value="2">(2) Horrible</option>
            <option value="1">(1) Appalling</option>
        </select>
    </div>
</div>
