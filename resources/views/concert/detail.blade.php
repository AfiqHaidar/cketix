<x-app-layout>

    <div
    class="py-32 bg-auto bg-repeat bg-center h-fit"
    style="background-image: url('{{ asset('storage/res/pattern2.png') }}');"
  >

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2 mb-7">
            <h1 class="mb-4 text-3xl font-extrabold dark:text-white md:text-5xl lg:text-6xl">{{ $concert->name }}</h1>
            <p class="text-lg font-normal text-white lg:text-xl dark:text-gray-400">{{ $concert->long_desc }}</p>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <h2 class="mb-4 text-3xl  dark:text-white md:text-4xl lg:text-5xl">Available Dates</h2>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2 flex mt-5 mb-7 overflow-x-scroll overflow-hidden hover:overflow-visible">
        @foreach ($concertDetails as $detail)

            <div class="max-w-fit  p-6 m-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a  href="#" data-modal-target="{{ $detail->id }}" data-modal-toggle="{{ $detail->id }}" class="flex items-center justify-center text-center " type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>  
                    <div class="ml-2">
                        <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $detail->date }}</h5>
                    </div>                    
              </a>
            </div>

            @include('concert.component.ticket')
    
        @endforeach
        


        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <h2 class="mb-4 text-3xl  dark:text-white md:text-4xl lg:text-5xl">Featured Guest Star</h2>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 mt-5">
        @foreach ($guestDetails as $guest)

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2">
                <div class="group relative cursor-pointer items-center justify-center overflow-hidden transition-shadow hover:shadow-xl hover:shadow-black/30">
                    <div class="h-96 w-72">
                      <img
                        class="h-full w-full object-cover transition-transform duration-500 group-hover:rotate-3 group-hover:scale-125"
                        src="{{ asset('storage/'. $guest->guest_image) }}"
                        alt=""
                      />
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black group-hover:from-black/70 group-hover:via-black/60 group-hover:to-black/70 "></div>
                    <div class="absolute inset-0 flex translate-y-[60%] flex-col items-center justify-center px-9 text-center transition-all duration-500 group-hover:translate-y-0">
                      <h1 class="font-dmserif text-3xl font-bold text-white"> {{ $guest->guest_name }} </h1>
                      <p class="mb-3 text-lg italic text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        {{ $guest->pquote }}
                      </p>
                      <a
                        href="{{ route('concert.guest', ['guest' => $guest->guest_name ]) }}"
                        class="rounded-full mt-10  px-3.5 py-2 font-com text-sm capitalize text-white bg-[#494949] hover:text-[#494949] hover:bg-white shadow shadow-black/60"
                      >
                        See More
                      </a>
                    </div>
                </div>
            </div>
              

        @endforeach
        </div>

    </div>
</x-app-layout>
