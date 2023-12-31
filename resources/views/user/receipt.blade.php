<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }} | {{ $transaction->id }} | {{ $payment->payment }}
        </h2>
    </x-slot>

    <div class="py-12">

        @foreach ($tickets as $ticket)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $ticket->tcode }} 
                        </div>
                    </div>
            </div>

        @endforeach

    
    </div>
</x-app-layout>
