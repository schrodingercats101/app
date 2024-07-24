<x-app-layout>
    <div class="flex">
        @include('layouts.user-side-bar')
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="columns-2 lg:columns-3 mt-16 mx-10 xl:columns-4">
                        <div class="grid gap-3">
                            @foreach ($photos as $photo)
                                <a href="{{ route('user.profile.photo.edit',['id' => $photo->id]) }}">
                                    <img style="width:300px" src="{{ $photo['path'] }}"  alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
