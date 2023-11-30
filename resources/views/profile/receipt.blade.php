<x-app-layout>
    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
     </button>
     
     <div class="flex justify-evenly pt-28 ">
        
        @include('components.sidebar')
     
     <div class="px-4 w-3/4">
        <div class="rounded-xl dark:border-gray-700">
            <div class="h-fit p-5 mb-4 rounded-xl bg-gray-50 flex justify-center">

                    <header class="flex flex-col w-3/5 p-3 border-dashed border-2 border-black">

                        <div  class="flex justify-between items-start p-5 text-center border-black border-b-2">
                            <div class=" h-20 flex justify-center items-center text-3xl font-bold text-gray-900">
                                <h1>RECEIPT</h1>
                            </div>
                            <div class="flex justify-center items-center text-3xl font-bold text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                </svg>
                                    {{-- <h1>CKETIX</h1> --}}
                            </div>
                        </div>

                        <div  class="flex justify-between items-start p-5 text-center">
                            <div class="flex flex-col justify-center items-start  text-gray-900">
                                <h1 class="font-semibold ">BILLED TO:</h1>
                                <h1>{{ $user->name }}</h1>
                                <h1>{{  $user->telephone_number  }}</h1>
                                <h1>{{ $user->email }}</h1>
                            </div>
                            <div class="flex flex-col justify-center items-end text-gray-900">
                                <h1>TR{{  str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</h1>
                                <h1>{{ $transaction->created_at }}</h1>
                            </div>
                        </div>

                        <div  class="flex justify-center items-center p-5 text-center">
                             

                            <div class="relative overflow-x-auto w-full">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Concert
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Category
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Ticket
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Price
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-t">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $details->name }}
                                            </th>
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $details->code }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $details->ticket_count }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $details->price }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $details->price * $details->ticket_count }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div  class="flex justify-between items-start pt-20 px-5 pb-5 text-center ">
                            <div class="flex flex-col justify-center items-start  text-gray-900">
                                <h1 class="font-semibold border-b-2 border-black">PAYMENT INFORMATION</h1>
                                <h1>Status : {{ $transaction->status }}</h1>
                                <h1>Method : {{ $payment->payment }}</h1>
                                <h1>Date   : {{ $transaction->updated_at }}</h1>
                            </div>
                            <div class="flex flex-col  justify-center items-center text-3xl font-bold text-gray-900">
                                    <h1>CKETIX</h1>
                                    <h1 class="text-sm font-light">developer team</h1>
                            </div>
                        </div>

                    </header>
                
            </div>
         </div>
     </div>
    </div>
</x-app-layout>
