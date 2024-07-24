<x-app-layout>
    <div>
        @include('layouts.admin-side-bar')
    </div>
    <div class="w-full mt-2">
        <div class="mt-16">
            <x-flash-message status="info"/>
        </div>
       <!-- component -->
        <section class="container px-4 mx-auto mt-2">
            <div class="flex flex-col px-4 mx-auto mt-10">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 bg-white md:rounded-lg">
                            <div class="columns-2 lg:columns-3 py-20 mx-10">
                                <div class="grid gap-3">
                                    @foreach ($photos as $photo)
                                        <div>
                                            <a href="{{ route('admin.users.photo.edit',['id' => $photo->id]) }}">
                                                <img class="rounded-lg" src="{{ $photo['path'] }}" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
