<x-app-layout>
    @push('scripts')
        @vite('/resources/js/user/like.js')
    @endpush
    <div class="w-1/2 items-center mx-auto py-20">
        <div class="flex items-center flex-col justify-center w-full">
            <img width="" src="{{ $photo->path }}">
        </div>
        <div class="mt-5 flex items-end justify-end ">
            <button id="like_btn" class="border-2 rounded-xl border-black px-3 ">
                @if ($like->isEmpty())
                <i class="fas fa-heart" id="like_toggle" data-photo-id="{{ $photo->id }}"></i>
                @else
                <i class="fas fa-heart liked" id="like_toggle" data-photo-id="{{ $photo->id }}"></i>
                @endif
                <span>いいねボタン</span>
            </button>
        </div><!-- /.likes -->

        <div class="flex items-center mx-auto flex-col justify-center w-1/2 border-2 border-black mt-5">
            <p class="font-bold text-lg ">メーカー</p>
            <div class="border-2 border-t-black w-full flex justify-center bg-gray-300">
                <p class="text-xl">
                    {!! nl2br($photo->manufacture->name) !!}
                </p>
            </div>
        </div>
        <div class="flex items-center mx-auto  flex-col justify-center w-1/2 mt-5 border-2 border-black ">
            <p class="font-bold text-lg">機種</p>
            <div class="border-2 border-t-black w-full flex justify-center bg-gray-300">
                <p class="text-xl">
                {!! nl2br($photo->kind->name) !!}
                </p>
            </div>
        </div>
        <div class="flex items-center mx-auto flex-col justify-center border-2 border-black mt-5">
            <p class="font-bold text-lg">設定</p>
            <div class="border-2 border-t-black w-full flex justify-center bg-gray-300">
                <p class="text-xl">
                {!! nl2br($photo->setting) !!}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
