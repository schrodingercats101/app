<x-app-layout>
    <div>
        @include('layouts.admin-side-bar')
    </div>
    <div class="w-full mt-10">
        <div class="mt-10">
            <x-flash-message status="info"/>
        </div>
        <!-- 追加一覧ボタン -->
        <section class="container sm:px-4 mx-auto sm:w-3/4 mt-10">
            <div class="flex items-center mt-6">
                <a href="{{ route('admin.camera.create') }}" :active="request()->routeIs('admin.camera.create')" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 ">
                    <span>
                        追加
                    </span>
                </a>
                <a href="{{ route('admin.camera.index') }}" :active="request()->routeIs('admin.camera.index')" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 ">
                    <span>
                        一覧
                    </span>
                </a>
            </div>
            <div class="mt-10 bg-white rounded-lg py-2 divide-gray-200 ">
                <form class="mt-8" method="post" action="{{ route('admin.camera.store') }}">
                    @csrf
                    <div class="sm:col-span-3 px-4 flex items-center px-auto">
                        <label for="anufacture_id" class="block text-sm font-medium leading-6 text-gray-900 w-1/4 text-center">メーカ名</label>
                        <div class="w-full">
                        <select id="" name="manufacture_id" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:1/2 sm:text-sm sm:leading-6" required>
                            <option selected value="">選択してください</option>
                            @foreach ($manufactures as $manufacture)
                                <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="sm:col-span-3 px-4 flex items-center mt-8">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900 w-1/4 text-center">種類</label>
                        <div class="w-full">
                        <select id="" name="type" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:1/2 sm:text-sm sm:leading-6" required>
                            <option selected value="">選択してください</option>
                            <option value="1">一眼レフ</option>
                            <option value="2">デジタルカメラ</option>
                        </select>
                        </div>
                    </div>
                    <div class="sm:col-span-3 px-4 mt-8 flex items-center">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 w-1/4 text-center">機種名</label>
                        <div class="w-full">
                        <input type="text" name="name" id="" placeholder="入力してください" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:w-1/2 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                    <div class="mt-12 mb-10 items-center flex justify-center">
                        <button type="submit" class="w-1/4 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">保存する</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
