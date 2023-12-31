<div class="z-0 max-screen mx-auto">
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-screen overflow-hidden rounded-lg bg-black " >
        
            @foreach ($banners as $banner)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="absolute w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <div class="relative">

                        <div>
                            <img src="{{ asset('storage/'. $banner->image) }}" class="absolute w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    
                        <div class="absolute w-full h-screen  -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 bg-gradient-to-r from-black from-10%"></div>
                        {{-- <div class="absolute w-full h-screen  -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 bg-gradient-to-t from-black from-10%"></div> --}}
                        <div class="absolute left-1/3 sm:left-28">
                            <div class=" text-6xl  font-semibold text-white">
                                {{ $banner->header }}
                            </div>    
                           
                            <div class='text-[#C9C9C9] text-2xl my-2 line-clamp-3 tracking-wider'>
                                {{ $banner->subheader }}
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            @endforeach
           

        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            @foreach ($banners as $banner)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $banner->id }}" data-carousel-slide-to="{{  $banner->id }}"></button>
            @endforeach
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-9 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-800 group-hover:bg-black/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-9 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-800 group-hover:bg-black/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div>