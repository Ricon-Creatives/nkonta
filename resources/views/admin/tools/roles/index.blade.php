@extends('admin.layouts.index')
@section('main')

    <div class="flex items-center mb-4 mt-4">
    <!-- With actions -->

        <div class="mx-2">
        <a href="{{ route('role.create') }}"
        class="px-4 py-2 font-medium leading-5 text-sm transition-colors duration-150 text-purple-600 border border-transparent rounded-lg
        active:text-gray-700 hover:text-gray-700 focus:outline-none focus:shadow-outline-purple">
        Create Role
        </a>
        <span class="text-gray-400">|</span>
        <a href="{{ route('file-import-export') }}"
        class="px-4 py-2 font-medium leading-5 text-sm transition-colors duration-150 text-purple-600 border border-transparent rounded-lg
        active:text-gray-700 hover:text-gray-700 focus:outline-none focus:shadow-outline-purple">
        Create Permission
        </a>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
        <div class="w-full overflow-x-auto">
            <div x-data="{
                activeTab:1,
                activeClass: 'inline-block px-4 py-2',
                inactiveClass : 'inline-block px-4 py-2'
             }" class="container mx-auto mt-20">
                <ul class="nav nav-tabs flex md:flex-row flex-wrap list-none border-b-0 pl-0 mb-3">
                    <li class="text-gray-500 dark:text-gray-100 hover:text-gray-900 {{ request()->routeIs('role.index') ? ' text-purple-600' : '' }}">
                        <a href="{{ route('role.index') }}" :class="activeTab === 1 ? activeClass : inactiveClass">Roles</a>
                    </li>
                    <li class="text-gray-500 dark:text-gray-100 hover:text-gray-900">
                        <a href="#" :class="activeTab === 2 ? activeClass : inactiveClass">Permissions</a>
                    </li>
                </ul>
            <div class="mt-2 bg-white border-0">
                @yield('content')
            </div>

        </div>
    </div>


@endsection
