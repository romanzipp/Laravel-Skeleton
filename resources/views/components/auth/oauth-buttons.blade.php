<div class="flex flex-col space-y-4">

    @foreach($services as $service)

        <a href="{{ $service->getOAuthRedirectUrl() }}"
           class="flex items-center space-x-4 rounded-lg p-3 text-center text-sm font-medium shadow text-white dark:text-white text-opacity-80 border border-gray-200 dark:border-gray-500 shadow"
           style="background-color: {{ $service->getHslaColor() }}">

            <div class="w-auto sm:w-1/3 flex justify-end">

                <img src="{{ asset("images/icons/{$service->getIconName()}-light.svg") }}"
                     alt="{{ $service->getTitle() }} Icon"
                     class="h-4 w-4 overflow-hidden fill-current text-white">

            </div>

            <div class="truncate">
                {{ __('Sign in with') }} {{ $service->getTitle() }}
            </div>

        </a>

    @endforeach

</div>
