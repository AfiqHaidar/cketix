<x-app-layout>
    @include('landing.hero')

    <div
    class="py-32 bg-auto bg-repeat bg-center h-fit"
    style="background-image: url('{{ asset('storage/res/pattern.png') }}');"
  >
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2 mb-7">
    <h1 class="mb-4 text-3xl font-extrabold dark:text-white md:text-5xl lg:text-6xl">Popular Concert</h1>
</div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center lg:grid lg:grid-cols-3 lg:gap-y-10">
        @foreach ($tops as $top)
            <div
            class="mb-10 hover:scale-110 h-[400px] hover:h-[500px] transition-all ease-in-out duration-1000 w-[360px] bg-cover shadow-2xl shadow-white/5 bg-no-repeat bg-start relative rounded-3xl group"
            style="background-image: url('{{  asset($top->image) }}');"
        >
            <div class="flex flex-col items-start justify-end px-8 w-full h-full bg-gradient-to-t from-[#0C0C0C] from-20% to-[#00000001] rounded-3xl">
            <div class="text-white font-bold font-lg pb-2 tracking-widest uppercase">
                {{ $top->name }}
            </div>
            <div class="text-[#C9C9C9] line-clamp-3 tracking-wider mb-6">
                This concert is Really Aweome
            </div>
            <div class="py-2 -mb-6 group-hover:mb-6  w-full text-white rounded-xl text-center bg-[#494949] opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-1000">
                <a class=""  href="{{ route('concert.detail', ['id' => $top->id ]) }}">See Details</a>
            </div>
            </div>
        </div>
        @endforeach
a
    </div>
</div>
</x-app-layout>
