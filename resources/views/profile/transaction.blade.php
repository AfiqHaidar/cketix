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
           <div class="h-fit p-5 mb-4 rounded-xl bg-gray-50 ">
               

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Date & Time
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                
            <tr class="bg-white border-b hover:bg-gray-100 text-center">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    TR{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT); }}
                </th>
                <td class="px-6 py-4">
                    {{ $transaction->created_at }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->total }}
                </td>
                <td class="px-6 py-4">
                    {{ $transaction->status }}
                </td>
                <td class="px-6 py-4 text-center">
                    @if ($transaction->status == 'PAID')
                    <a href="{{ route('profile.receipt', ['transaction' => $transaction ]) }}" class="font-medium  hover:underline">Receipt</a>
                    @elseif ($transaction->status == 'CANCELED')
                    <p>-</p>
                    @else
                    
                    <form method="POST" action="{{ route('ticket.payment', ['transaction' => $transaction ]) }}"  enctype="multipart/form-data">
                        @csrf       
                        <div class="flex justify-center items-center">
                        <div class="">
                            
                            <input type="file" name="image" id="image" class="form-control-file  block text-sm text-black border border-gray-300 rounded-l-lg cursor-pointer bg-gray-50 focus:outline-none  ">
                           
                            @error('image')
                            <p class=" text-sm text-red-600 dark:text-gray-200" id="file_input_help">{{ $message }}</p>
                            @enderror
                        </div>
           
                        <div class=" flex justify-center">
                            <button type="submit" class="rounded-r-lg group flex justify-center items-center bg-gray-800 px-3.5 py-[0.66rem] font-com text-sm capitalize text-white shadow shadow-black/60 hover:bg-gray-700" >Upload</button>
                        </div>
                    </div>
                         </form>

                    @endif
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

           </div>
        </div>
     </div>
    </div>
</x-app-layout>