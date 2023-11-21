<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $concert }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach ($concertDetails as $detail)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                <a href="#" data-modal-target="{{ $detail->id }}" data-modal-toggle="{{ $detail->id }}" class="block " type="button">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $detail->id }}. {{ $detail->date }}
                        </div>
                    </div>
                </a>
            </div>
            @include('concert.component.ticket');
    
        @endforeach


        @foreach ($guestDetails as $guest)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                <a href="{{ route('concert.guest', ['guest' => $guest->guest_name ]) }}">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $guest->guest_name }}
                        </div>
                    </div>
                </a>
            </div>

        @endforeach

    </div>
</x-app-layout>
