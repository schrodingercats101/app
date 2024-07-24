<x-app-layout>
    <div class="mt-20 mx-10 columns-3 px-6 lg:columns-4 lg:px-12 xl:columns-5 xl:px-16">
        <div class="grid gap-3">
            @foreach ($user_images as $user_image)
                <a class="" href="{{ route('user.photo.detail',['id' => $user_image->id]) }}">
                    <img class="rounded-lg" src="{{ $user_image['path'] }}">
                </a>
            @endforeach
        </div>
    </div>
    {{ $user_images->links() }}
</x-app-layout>



