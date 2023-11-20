<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @foreach ($transactions as $transaction)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                <a href="#">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ $transaction->date }} 
                        </div>
                    </div>
                </a>
            </div>

        @endforeach

    
    </div>
</x-app-layout>
