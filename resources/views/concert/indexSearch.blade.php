<x-app-layout>
    <div
    class="py-32 bg-auto bg-repeat bg-center h-fit"
    style="background-image: url('{{ asset('storage/res/pattern.png') }}');"
  >
  <div class="max-w-7xl mx-auto mb-10 sm:px-6 lg:px-8 flex flex-col justify-center items-center">

    <div class="w-3/4">
        <form method="POST" action="{{ route('concert.index.search') }}"  enctype="multipart/form-data">   
        @csrf
        <label for="csearch" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        
        <div class="relative">
            <input type="search" id="csearch" name='csearch' class="block w-full py-4 px-7 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Concert" required>
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>
    </div>
    
    

</div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center lg:grid lg:grid-cols-3 lg:gap-y-10">
        @foreach ($concerts as $concert)
            @include('landing.concert')
        @endforeach

    </div>
</div>
</x-app-layout>
