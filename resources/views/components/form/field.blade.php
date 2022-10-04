<div>

    <label for="{{ $id }}" class="block mb-2 text-xs text-gray-500 font-medium uppercase">

        {{ $computedLabel }}

        @if($required)
            <span class="text-red-600">*</span>
        @endif

    </label>

    <input id="{{ $id }}"
           type="{{ $type }}"
           name="{{ $name }}"
           value="{{ $computedValue }}"
           autocomplete="{{ $autocomplete }}"
           placeholder="{{ $computedPlaceholder }}"
           @if($required) required @endif
           @if($autofocus) autofocus @endif
           class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm
                focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50
                dark:border-gray-600 dark:bg-gray-700
                    dark:focus:ring-primary-700 dark:focus:border-primary-700
                @if($errors->has($name)) input-error @endif"
           style="outline: none">

    @if($errors->has($name))

        <div class="mt-1 text-xs text-red-800">
            {{ $errors->first($name) }}
        </div>

    @endif

</div>
