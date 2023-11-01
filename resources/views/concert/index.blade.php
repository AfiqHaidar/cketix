<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Concert List') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @foreach ($concerts as $concert)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                <a href="{{ route('concert.detail', ['concert' => $concert ]) }}">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $concert->name }}
                        </div>
                    </div>
                </a>
            </div>

        @endforeach

    
    </div>
</x-app-layout>
