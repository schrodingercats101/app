<x-app-layout>
    @push('scripts')
        @vite('/resources/js/user/search.js')
    @endpush
    <div>
        <form id="searchForm" class="w-3/4 items-center mx-auto mt-20 px-6 py-6 lg:px-8 sm:rounded-lg bg-white" action="{{ route('user.search.result') }}" method="GET" >
            @csrf
            <div class="mt-10 w-3/4 mx-auto">
                <div class="mt-6 w-1/2 mx-auto">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">カテゴリー</label>
                    <select id="category" name="category" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" id="selected">選択してください</option>
                        @foreach (Config::get('category.list') as $key => $val)
                        <option value="{{ $key }}" @if(isset($old['category'])) @if( $key == $old['category']) selected @endif @endif id="selected">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex">
                    <div class="mt-6 w-full mx-2">
                        <label for="manufacture" class="block mb-2 text-sm font-medium text-gray-900">メーカー名</label>
                            <div class="items-center hidden" id="manufacture_show">
                                <p id="manufacture_text" class="mr-3"></p>
                                <div class="justify-end">
                                    <button id="change_btn" type="button" class="block text-white bg-gray-400 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">変更する</button>
                                </div>
                                {{-- <input id="manufacture_input" name="manufacture_id" type="text" class="hidden" value=""> --}}
                            </div>
                        <select id="manufacture_select" name="manufacture_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                            <option value="0">選択してください</option>
                            @foreach ($manufactures as $manufacture)
                                <option value="{{ $manufacture->id }}" @if(isset($old['manufacture_id'])) @if( $manufacture->id == $old['manufacture_id']) selected @endif @endif>{{ $manufacture->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-6 w-full" id="type_area mx-2">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900">種類</label>
                        <select id="search_type_select" name="type" class="select-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value="">
                            <option value="" >選択してください</option>
                            <option value="1" @if (isset($old['type'])) @if( 1 == $old['type']) selected @endif @endif>デジタルカメラ</option>
                            <option value="2" @if (isset($old['type'])) @if( 2 == $old['type']) selected @endif @endif>一眼</option>
                        </select>
                    </div>
                    <div class="mt-6 w-full mx-2">
                        <label for="kind" class="block mb-2 text-sm font-medium text-gray-900">機種名</label>
                        <div class="items-center hidden" id="kind_show">
                            <p id="kind_text" class="mr-3"></p>
                            <input id="kind_input" name="kind_id" type="text" class="hidden" value="">
                        </div>
                        <select id="kind_select" name="kind_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                            <option value="" selected>選択してください</option>
                        </select>
                    </div>
                </div>
                <div id="" class="my-10 id= w-3/4 mx-auto flex justify-center">
                    <button id="search_btn" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center ">検索</button>
                </div>
            </div>
        </form>
    @if (isset($old))
    <script>
        let old = "<?php echo $old['kind_id']; ?>"
    </script>
    @endif
    <div class="columns-3 lg:columns-4 mt-16 mx-5 xl:columns-5">
        <div class="grid gap-3">
            @foreach ($photos as $photo)
                <a href="{{ route('user.photo.detail',['id' => $photo->id]) }}">
                    <img class="rounded-lg" src="{{ $photo['path'] }}">
                </a>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>
