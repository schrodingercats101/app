<x-app-layout>
@push('scripts')
    @vite('/resources/js/user/edit.js')
@endpush
    <div class="flex">
        @include('layouts.user-side-bar')
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form id="uploadForm" class="w-1/2 items-center mx-auto mt-20" action="{{ route('user.profile.photo.update',['id' => $photo->id]) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="flex items-center justify-center w-full">
                            <div class="flex items-center flex-col justify-center w-full">
                                <img width="" src="{{ $photo->path }}">
                            </div>
                        </div>
                        <div class="w-5">
                            <div id="show-image" class="items-center justify-center w-full">
                                <img src="" id="preview" style="width:500px">
                            </div>
                            <div id="delete-area" class="hidden justify-end mt-4">
                                <button id="delete-btn" type="button" class="block text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">削除する</button>
                            </div>
                        </div>
                        <div class="mt-10 w-3/4 mx-auto">
                            <div class="mt-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900">作品名</label>
                                <input id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $photo->name }}"/>
                            </div>
                            <div class="mt-6">
                                <label for="manufacture" class="block mb-2 text-sm font-medium text-gray-900">メーカー名</label>
                                    <div class="items-center hidden" id="manufacture_show">
                                        <p id="manufacture_text" class="mr-3"></p>
                                        <div class="justify-end">
                                            <button id="change_btn" type="button" class="block text-white bg-gray-400 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">変更する</button>
                                        </div>
                                    </div>
                                <select id="manufacture_select" name="manufacture_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                                    @foreach ($manufactures as $manufacture)
                                        <option value="{{ $manufacture->id }}"
                                            @if ($photo->manufacture->id === $manufacture->id) selected @endif>{{ $manufacture->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-6" id="type_area">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900">種類</label>
                                <select name="type" id="type_select" class="select-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value=>
                                    <option value="1 @if ($photo->kind->type == 1) selected @endif">デジタルカメラ</option>
                                    <option value="2 @if ($photo->kind->type == 2) selected @endif">一眼</option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <label for="kind" class="block mb-2 text-sm font-medium text-gray-900">機種名</label>
                                <div class="items-center hidden" id="kind_show">
                                    <p id="kind_text" class="mr-3"></p>
                                    <input id="kind_input" name="kind_id" type="text" class="hidden" value="">
                                    <div class="justify-end">
                                        <button id="change_btn" type="button" class="block text-white bg-gray-400 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">変更する</button>
                                    </div>
                                </div>
                                <select name="kind_id" id="kind_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                                    <option selected value="{{ $photo->kind->id }}">{{ $photo->kind->name }}</option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900">カテゴリー</label>
                                <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    @foreach (Config::get('category.list') as $key => $val)
                                    <option value="{{ $key }}" @if ($photo->category == $key) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-6">
                                <label for="setting" class="block mb-2 text-sm font-medium text-gray-900">設定</label>
                                <textarea id="setting" name="setting" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $photo->setting }}</textarea>
                            </div>
                            <div id="sub" class="my-10 mx-auto flex justify-center">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center ">編集</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" action="{{ route('user.profile.photo.destroy',$photo->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="my-10 flex justify-center">
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-10 py-2.5 text-center " onclick='return confirm("本当に削除しますか？")'>削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
