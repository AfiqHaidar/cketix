

    <div
      class="mb-10 hover:scale-110 h-[400px] hover:h-[500px] transition-all ease-in-out duration-1000 w-[360px] bg-cover shadow-2xl shadow-white/5 bg-no-repeat bg-start relative rounded-3xl group"
      style="background-image: url('{{  asset($concert->image) }}');"
    >
      <div class="flex flex-col items-start justify-end px-8 w-full h-full bg-gradient-to-t from-[#0C0C0C] from-20% to-[#00000001] rounded-3xl">
        <div class="text-white font-bold font-lg pb-2 tracking-widest uppercase">
          {{ $concert->name }}
        </div>
        <div class="text-[#C9C9C9] line-clamp-3 tracking-wider mb-6">
          This concert is Really Aweome
        </div>
        <div class="py-2 -mb-6 group-hover:mb-6  w-full text-white rounded-xl text-center bg-[#494949] opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-1000">
          <a href="">See Details</a>
        </div>
      </div>
    </div>

