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
            <div id="accordion-collapse" data-accordion="collapse">

                @foreach ($concerts as $concert)


                <h2 id="accordion-collapse-heading-{{ $concert->id }}">
                  <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-black border  border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700  hover:bg-gray-100 gap-3" data-accordion-target="#accordion-collapse-body-{{ $concert->id }}" aria-expanded="true" aria-controls="accordion-collapse-body-{{ $concert->id }}">
                    <span>{{ $concert->name }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                  </button>
                </h2>


                <div id="accordion-collapse-body-{{ $concert->id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $concert->id }}">
                  <div class="p-20 border border-gray-200 grid grid-cols-2 gap-5  ">


                    @foreach ($tickets as $ticket)

                    @if ($ticket->concert_name == $concert->name)

                    <div class=" w-full flex flex-row items-center bg-cover bg-no-repeat border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl"
                    style="background-image: url('{{  asset('storage/'.$concert->image) }}');">
                        <div  class="flex flex-col   w-4/5 justify-between p-4 leading-normal ">
                            <h1 class="filter-none mb-10 text-5xl font-bold tracking-tight text-white">{{ $ticket->concert_name }}</h1>
                            <div class="flex flex-row justify-start gap-5">
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <h1 class="ml-2 text-lg font-bold tracking-tight text-white">{{ $ticket->venue_name }}</h1> 
                                </div>
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                      </svg>                                      
                                    <h1 class="ml-2 text-lg font-bold tracking-tight text-white">{{ $ticket->date }}</h1> 
                                </div>
                            </div>
                            <div>
                                <h1 class="mt-10 text-2xl font-bold tracking-tight text-white">{{ $ticket->tcode }}</h1> 
                            </div>
                        </div>
                        <div class="w-1/5 flex justify-center items-center  border-l-2 border-dashed h-full">
                            <img class="w-4/5 rounded-lg" src="/storage/res/rr.png" alt="">
                        </div>
                    </div>

                    @endif

                    @endforeach

                  </div>
                </div>

                @endforeach
                
              </div>
           </div>
        </div>

     </div>
    </div>
</x-app-layout>