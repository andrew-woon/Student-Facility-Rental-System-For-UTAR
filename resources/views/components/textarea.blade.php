@props(['disabled' => false])

<textarea 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge([
        'class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize-none overflow-auto px-2 py-1'
    ]) !!}
    rows="3"
>{{ $slot }}</textarea>
