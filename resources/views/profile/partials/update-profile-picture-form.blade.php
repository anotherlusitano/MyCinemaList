<section>
    <header>
        <h2 class="text-lg font-medium text-gray-100">
            {{ __('Change Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile picture.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update_picture', $user->id) }}" class="mt-6 space-y-6"
          enctype="multipart/form-data">
        @csrf
        @method('patch')

        <img src="{{old('picture', asset($user->picture))}}" alt="Profile Picture" class="max-w-44 max-h-52">

        <div>
            <x-input-label for="picture" :value="__('Picture')"/>
            <x-text-input id="picture" name="picture" type="file" class="mt-1 block w-full" autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('picture')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
