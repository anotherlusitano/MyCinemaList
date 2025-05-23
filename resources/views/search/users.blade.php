<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4">
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Users</h2>

            @foreach ($users as $user)
                @php
                    $date = new \Carbon\Carbon($user->created_at);
                    $account_created = $date->isoFormat('MMMM D, YYYY');
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ $user->picture }}" alt="{{ $user->username }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="#"
                           class="text-blue-600 font-medium hover:underline">{{ $user->username }}</a>
                        <div class="text-gray-700 text-sm">Created at {{ $account_created}}</div>
                    </div>
                </li>
            @endforeach

            @if($users->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">No Users?</p>
                </div>
            @endif

            {{ $users->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
