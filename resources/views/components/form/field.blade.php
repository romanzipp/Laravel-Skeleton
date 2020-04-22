<div class="field my-4">

    <label for="{{ $id }}">

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
           class="input @if($errors->has($name)) input-error @endif">

    @if($errors->has($name))

        <div class="mt-1 text-xs text-red-800">
            {{ $errors->first($name) }}
        </div>

    @endif

</div>
