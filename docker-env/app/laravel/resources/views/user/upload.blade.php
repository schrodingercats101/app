<x-app-layout>
    @push('scripts')
        @vite('/resources/js/user/upload.js')
    @endpush
    <div class="mt-16">
        <x-flash-message status="info"/>
    </div>
    <form id="uploadForm" class="w-1/2 items-center mx-auto py-16" action="{{ route('user.upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file" id="dropzone" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p>画像を選択</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" name="file" value=""/>
            </label>
        </div>
        <div class="">
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
                <input id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value=""/>
            </div>
            <div class="mt-6">
                <label for="manufacture" class="block mb-2 text-sm font-medium text-gray-900">メーカー名</label>
                    <div class="items-center hidden" id="manufacture_show">
                        <p id="manufacture_text" class="mr-3"></p>
                        <div class="justify-end">
                            <button id="change_btn" type="button" class="block text-white bg-gray-400 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">変更する</button>
                        </div>
                        <input id="manufacture_input" name="manufacture_id" type="text" class="hidden" value="">
                    </div>
                <select id="manufacture_select" name="manufacture_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                    <option selected value="">選択してください</option>
                    @foreach ($manufactures as $manufacture)
                        <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-6" id="type_area">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900">種類</label>
                <select id="type_select" name="type" class="select-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " value=>
                    <option selected value="">選択してください</option>
                    <option value="1">デジタルカメラ</option>
                    <option value="2">一眼</option>
                </select>
            </div>
            <div class="mt-6">
                <label for="kind" class="block mb-2 text-sm font-medium text-gray-900">機種名</label>
                <div class="items-center hidden" id="kind_show">
                    <p id="kind_text" class="mr-3"></p>
                    <input id="kind_input" name="kind_id" type="text" class="hidden" value="">
                </div>
                <select id="kind_select" name="kind_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="">
                    <option selected value="">選択してください</option>
                </select>
            </div>
            <div class="mt-6">
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900">カテゴリー</label>
                <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected value="" id="selected">選択してください</option>
                    @foreach (Config::get('category.list') as $key => $val)
                    <option value="{{ $key }}" id="selected">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-6">
                <label for="setting" class="block mb-2 text-sm font-medium text-gray-900">設定</label>
                <textarea id="setting" name="setting" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div id="" class="my-10 id= w-3/4 mx-auto flex justify-center">
                <button id="upload_btn" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">アップロード</button>
            </div>
        </div>
    </form>
</x-app-layout>
