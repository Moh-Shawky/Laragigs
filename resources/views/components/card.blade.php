@props(['Listing'])
<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="{{$Listing->logo ?
        asset('/storage/'.$Listing->logo) : asset('images/no-image.png')}}" alt="" />
        <div>
            <h3 class="text-2xl">
                <a href="show/{{ $Listing->id }}">{{ $Listing->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $Listing->company }}</div>
            @php
                $tags = $Listing->tags;
                $tags_arr = explode(',', $tags);
            @endphp



            {{-- <form action="" method="post"> --}}
            <ul class="flex">
                @foreach ($tags_arr as $tag)
                    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                        <a href="/?tag={{$tag}}">{{ $tag }}</a>
                    </li>
                @endforeach
            </ul>
            {{-- </form> --}}
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $Listing->location }}
            </div>
        </div>
    </div>
</div>
