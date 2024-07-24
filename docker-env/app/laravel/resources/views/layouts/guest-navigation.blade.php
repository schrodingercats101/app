<nav x-data="{ open: false }" class="bg-gray-400">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('user.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                        {{ __('トップページ') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('user.upload')" :active="request()->routeIs('user.upload')">
                        {{ __('アップロード') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('user.search')" :active="request()->routeIs('user.upload')">
                        {{ __('検索する') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-nav-link :href="route('user.login')" :active="request()->routeIs('user.upload')">
                    {{ __('ログイン') }}
                </x-nav-link>
            </div>

            <!-- Hamburger -->
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
    </div>
</nav>
