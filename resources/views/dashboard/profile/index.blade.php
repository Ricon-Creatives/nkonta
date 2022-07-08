@if(session()->has('message'))
<div class="absolute right-0 bottom-0 p-1">
    <div class="flex items-center px-4 py-2 rounded  text-white bg-green-400" role="alert">
        <p>{{ session()->get('message') }}</p>
    </div>
  </div>
@endif
<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1  sm:grid-cols-4 bg-white h-screen">
      <!--Heading-->
   <x-slot name="header">
    </x-slot>
     <!---->
    <div class="p-2 mx-1 border-r">
        <div class="flex flex-col text-center my-4">
            <h1 class="text-base font-bold text-gray-800 m-1">{{ Auth::user()->name }}</h1>
            <p class="text-sm font-semibold text-gray-600">{{ Auth::user()->company_name }}</p>
            <p class="text-sm font-semibold my-1 text-gray-600">
                 @foreach ( Auth::user()->roles as $role)
                {{$role->name }}
                @endforeach</p>
        </div>
        <ul class="nav nav-tabs flex flex-col flex-wrap list-none border-b-0 pl-0 mr-4" id="tabs-tabVertical"
    role="tablist">
    <li class="nav-item flex-grow text-center border-b  {{ request()->routeIs('profile') ? 'text-indigo-800' : '' }}" role="presentation">
      <a href="{{ route('profile') }}" class=" block
          font-semibold text-xs leading-tight uppercase px-6 py-3 my-1
          hover:border-transparent hover:bg-gray-100
          focus:border-transparent
        " id="tabs-home-tabVertical">
        <i class="fa-solid fa-user mr-2"></i>Account
        </a>
    </li>
    <li class="nav-item flex-grow text-center border-b {{ request()->routeIs('profile.password') ? 'text-indigo-800' : '' }}
        hover:border-transparent hover:bg-gray-100 " role="presentation">
      <a href="{{ route('profile.password') }}" class="
          block font-semibold text-xs leading-tight uppercase px-6
          py-3 my-1 focus:border-transparent
        " id="tabs-profile-tabVertical">
         <i class="fa-solid fa-key mr-2"></i>Password</a>
    </li>
  <!--  <li class="nav-item flex-grow text-center border-b" role="presentation">
      <a href="#tabs-messagesVertical" class="
          block
          font-semibold
          text-xs
          leading-tight
          uppercase
          px-6
          py-3
          my-1
          hover:border-transparent hover:bg-gray-100
        " id="tabs-messages-tabVertical" data-bs-toggle="pill" data-bs-target="#tabs-messagesVertical" role="tab"
        aria-controls="tabs-messagesVertical" aria-selected="false">
        <i class="fa-solid fa-shield mr-2"></i> Security
    </a>
    </li>-->
  </ul>
    </div>

    <!---->
    <div class="col-span-3 p-2 mx-1">
        <div class="tab-content" id="tabs-tabContentVertical">
          @yield('content')
          </div>
    </div>

</x-app-layout>
