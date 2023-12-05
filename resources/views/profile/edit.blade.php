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
                @include('profile.partials.update-profile-information-form')
           </div>
        </div>
    
        <div class="rounded-xl dark:border-gray-700">
            <div class="h-fit p-5 mb-4 rounded-xl bg-gray-50 ">
                @include('profile.partials.update-password-form')
            </div>
         </div>
    
         <div class="rounded-xl dark:border-gray-700">
            <div class="h-fit p-5 mb-4 rounded-xl bg-gray-50 ">
                @include('profile.partials.delete-user-form')
            </div>
         </div>
     </div>
    </div>
</x-app-layout>
