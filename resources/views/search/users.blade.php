<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <form method="GET" action="{{ route('search') }}"
              class="flex flex-col px-10 max-w-xs w-1/4"
        >
            <input type="hidden" name="type" value="users">
            <div
                class="flex items-center bg-white border border-gray-300 rounded-2xl shadow-sm mb-6 w-full max-w-sm">
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Search..."
                    class="bg-white text-sm text-gray-800 placeholder-gray-400 w-full border-none rounded-2xl"
                />
                <button type="submit"
                        class="ml-2 p-2 text-gray-600 hover:text-blue-600 focus:outline-none">
                    <x-tabler-search class="w-5 h-5"/>
                </button>
            </div>
            <select name="sort" class="mb-4">
                <option value="username|asc" {{ request('sort') == 'username|asc' ? 'selected' : '' }}>A-z</option>
                <option value="username|desc" {{ request('sort') == 'username|desc' ? 'selected' : '' }}>Z-a
                </option>
                <option value="created_at|desc" {{ request('sort') == 'created_at|desc' ? 'selected' : '' }}>Recent
                </option>
                <option value="created_at|asc" {{ request('sort') == 'created_at|asc' ? 'selected' : '' }}>Oldest
                </option>
            </select>
        </form>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Users</h2>

            @foreach ($users as $user)
                @php
                    $date = new \Carbon\Carbon($user->created_at);
                    $account_created = $date->isoFormat('MMMM D, YYYY');
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ asset($user->picture) }}" alt="{{ $user->username }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/users/{{ $user->id }}"
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
