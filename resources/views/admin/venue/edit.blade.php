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
        <div class="rounded-xl dark:border-gray-700">
           <div class="h-fit p-5 mb-4 rounded-xl bg-gray-50 ">
               

<div class="relative flex justify-center overflow-x-auto  sm:rounded-lg">
    <div class="w-1/3 p-10 bg-[#1A1A1A] shadow-lg rounded-lg flex-col justify-center items-center">
        <header class="pb-10 flex justify-evenly items-center">
            <img class="h-40 object-contain w-20 rounded-lg shadow-xl" src="{{ asset('storage/' . $concert->image) }}" alt="">
            <div>
                <h2 class="text-3xl font-medium white dark:text-gray-100">
                    {{ __('Edit Concert') }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-300 dark:text-gray-400">
                    {{ __("Change the necessary data") }}
                </p>
            </div> 
        </header>
        <form method="POST" action="{{ route('admin.updateConcert',['concert' => $concert]) }}"  enctype="multipart/form-data">
 
            @csrf
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $concert->name }}" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg  block w-full p-2.5" >
                @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-gray-200" id="file_input_help">{{ $message }}</p>
                @enderror
                </div>
 
            <div class="mb-6">
                <label class="block mb-2 text-sm w-full font-medium text-white dark:text-white" for="image">Image</label>
                <input type="file" name="image" id="image"  class="form-control-file  block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none  ">
                <p class="mt-1 text-sm text-gray-300 dark:text-gray-200" id="file_input_help">PNG or JPEG (MAX. 20MB).</p>
                @error('image')
                <p class="mt-1 text-sm text-red-600 dark:text-gray-200" id="file_input_help">{{ $message }}</p>
                @enderror
                </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="short_desc">Short Description</label>
                <input type="text" id="short_desc" value="{{ $concert->short_desc }}" name="short_desc" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg  block w-full p-2.5 " >
                @error('short_desc')
                <p class="mt-1 text-sm text-red-600 dark:text-gray-200" id="file_input_help">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-white dark:text-white" for="long_desc">Long Description</label>
                <input type="text" id="long_desc" value="{{ $concert->long_desc }}" name="long_desc" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg  block w-full p-2.5 " >
                @error('long_desc')
                <p class="mt-1 text-sm text-red-600 dark:text-gray-200" id="file_input_help">{{ $message }}</p>
                @enderror
            </div>

             <div class="my-2 pt-10 flex justify-center">
                 <button type="submit" class="rounded-lg group w-full flex justify-center items-center bg-gray-500 px-3.5 py-2 font-com text-sm capitalize text-white shadow shadow-black/60 hover:bg-slate-50 hover:text-gray-800" >Update</button>
             </div>
              </form>
         </div>
     </div>
</div>

           </div>
        </div>
     </div>        
     </div>
    </div>
</x-app-layout>
