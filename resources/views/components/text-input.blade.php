@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-white text-black focus:border-white focus:ring-white rounded-md shadow-sm']) !!}>
