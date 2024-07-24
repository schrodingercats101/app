<x-app-layout>
    <div>
        @include('layouts.admin-side-bar')
    </div>
    <div class="w-full mt-10">
        <form method="GET" class="max-w-md mx-auto" action="{{ route('admin.users.retrieve') }}">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">検索する</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="retrieve" name="retrieve" id="default-retrieve" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="メールアドレスか名前で検索してください"/>
               <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">検索</button>
            </div>
        </form>
       <!-- component -->
        <section class="container px-4 mx-auto mt-2">
            <div class="flex flex-col px-4 mx-auto mt-10">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200  md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                            名前
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 ">
                                        </th>
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500  whitespace-nowrap">
                                            <div class="items-center gap-x-2">
                                                <div>
                                                    <p class="text-xs font-normal text-gray-600 ">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6 justify-around">
                                                <a href="{{ route('admin.users.edit',$user->id) }}" class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                                    編集
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6 justify-around">
                                                @if (!$user->trashed())
                                                <form method="post" action="{{ route('admin.users.destroy',$user->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class=" text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none" onclick='return confirm("本当に削除しますか？")'>
                                                        停止する
                                                    </button>
                                                </form>
                                                @else
                                                <form method="post" action="{{ route('admin.users.restore',$user->id) }}">
                                                    @csrf
                                                    <button type="submit" class=" text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none" onclick='return confirm("本当に復元しますか？")'>
                                                        復元
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center my-8 py-5 bg-white border border-gray-200">
                <div>
                    {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
