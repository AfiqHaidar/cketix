<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Available Catagories for {{ $ticket }} ticket
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach ($catagories as $cat)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                <a href="#"  data-modal-target="{{ $cat->id }}" data-modal-toggle="{{ $cat->id }}" class="block text-white " type="button">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $cat->code }} : {{ $cat->price }}
                        </div>
                    </div>
                </a>
            </div>
            @include('concert.component.payment');

        @endforeach
    </div>
    

  
</x-app-layout>
