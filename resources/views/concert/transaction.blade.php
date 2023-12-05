<x-app-layout>

    <div class="flex justify-center items-center outline w-screen h-screen bg-repeat bg-center"  style="background-image: url('{{ asset('storage/res/pattern3.png') }}');">

        <div class="flex flex-row bg-white items-center justify-evenly rounded-xl max-w-7xl mx-auto">
            <div class="w-1/2  pl-10 py-5 flex justify-center items-center  ">
                 <img class="w-4/5 rounded-xl shadow " src=" {{ asset('storage/'.$detail->map) }}" alt="">
            </div>
           
            <div class="rounded-xl flex flex-col py-5 justify-between w-1/2 ">
                <div class="pr-10   bg-white  rounded-lg ">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Available Catagory</h5>
                </div>
                <div class="flow-root">
                        <ul role="list" class="shadow divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($catagories as $cat)
                            @if ($cat->seat >= $ticket)
                            <li class="py-3 sm:py-4 hover:bg-gray-200 rounded-xl">
                                <a href="#"  data-modal-target="{{ $cat->id }}" data-modal-toggle="{{ $cat->id }}" type="button" class="flex items-center">
                                    <div class="flex-shrink-0 ml-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                          </svg>
                                           </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $cat->code }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ $cat->description }}
                                        </p>
                                    </div>
                                    <div class="inline-flex mr-5 items-center text-base font-semibold text-gray-900 dark:text-white">
                                        Rp {{ $cat->price }}
                                    </div>
                                </a>
                            </li>  
                            @include('concert.component.payment')

                            @endif
                        @endforeach  
                        </ul>
                    </div>
                </div>

            </div>
        </div>


    </div>
    

  
</x-app-layout>
