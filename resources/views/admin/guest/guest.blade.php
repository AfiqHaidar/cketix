<x-app-layout>
    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
     </button>
     
     <div class="flex justify-evenly pt-28 ">
        
        @include('components.admin.sidebar')
     
     <div class="px-4 w-3/4">
        <div class="px-5 py-2 mx-auto my-3 hover:text-white bg-gray-300 hover:bg-white shadow-lg rounded-lg w-fit">
            <a href=" {{ route('admin.addGuest') }}"  class="text-black">Add Guest</a>
        </div>
        
        <div class="rounded-xl dark:border-gray-700">
           <div class="h-fit p-5 mb-4 rounded-xl bg-gray-50 ">
               

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="text-center px-6 py-3">
                    ID
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Name            
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Image
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Personal Quote
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guests as $guest)
            <tr class="bg-white border-b hover:bg-gray-100 ">
                <th scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    GS{{ str_pad($guest->id, 3, '0', STR_PAD_LEFT); }}
                </th>
                <td class="text-center px-6 py-4">
                    {{ $guest->name }}
                </td>
                <td class="text-center px-6 py-4">
                    {{ $guest->image }}
                </td>
                <td class="text-center px-6 py-4">
                    {{ $guest->pquote }}
                </td>
                <td class="flex justify-evenly items-center px-6 py-4 text-right">
                    <a href="{{ route('admin.editGuest', ['id' => $guest->id])  }}" class="font-medium  hover:underline">Edit</a>
                    <a href="{{ route('admin.deleteGuest', ['guest' => $guest]) }}" class="font-medium  hover:underline">Delete</a>
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
    </div>
</x-app-layout>
