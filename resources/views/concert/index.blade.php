<x-app-layout>
    <div
    class="py-32 bg-auto bg-repeat bg-center h-screen"
    style="background-image: url('{{ asset('storage/res/pattern.png') }}');"
  >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center lg:grid lg:grid-cols-3 lg:gap-y-10">
        @foreach ($concerts as $concert)

        @include('landing.concert')

        @endforeach

    </div>
</div>


</x-app-layout>
