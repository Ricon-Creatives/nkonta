 <!-- Desktop sidebar -->
 <aside
 class="z-20 hidden w-56 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
>
 <div class="py-4 text-gray-500 dark:text-gray-400">
   <a
     class="inline-flex items-center ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
     href="{{ route('dashboard') }}"
   >
   <img src="{{asset('img/logo.png') }}"/>

   </a>
   <ul class="mt-6">
       <li class="relative px-6 py-3">
           <span
           class="{{ request()->routeIs('dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
           aria-hidden="true"
           ></span>
           <a
           class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
           {{ request()->routeIs('dashboard') ? ' text-gray-800 dark:text-gray-100' : '' }}"
           href="{{ route('dashboard') }}"
           >
           <i class="fa-solid fa-dashboard"></i>
           <span class="ml-4">Dashboard</span>
        </a>
    </li>
    <li class="relative px-6 py-3">
      <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        href="{{ route('home') }}"
      >
      <i class="fa-solid fa-home"></i>
        <span class="ml-4">Visit Site</span>
      </a>
    </li>
   </ul>
   <ul>
     <li class="relative px-6 py-3">
        <span
        class="{{ request()->routeIs('account.index') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
        aria-hidden="true"
        ></span>
        <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
        {{ request()->routeIs('account.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
        href="{{ route('account.index') }}"
      >
        <i class="fa-solid fa-thumb-tack"></i>
         <span class="ml-4">Accounts</span>
       </a>
     </li>
     <li class="relative px-6 py-3">
        <span
        class="{{ request()->routeIs('transaction.index') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
        aria-hidden="true"
        ></span>
        <a
          class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
          {{ request()->routeIs('transaction.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
          href="{{ route('transaction.index') }}"
        >
          <i class="fa-solid fa-wallet"></i>
          <span class="ml-4">Transactions</span>
        </a>
      </li>
     <li class="relative px-6 py-3">
        <span
        class="{{ request()->routeIs('user.index') ? 'absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' : '' }}"
        aria-hidden="true"
        ></span>
       <a href="{{ route('user.index') }}"
         class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
         {{ request()->routeIs('user.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
       >
       <i class="fa-solid fa-user"></i>
         <span class="ml-4">Users</span>
       </a>
     </li>

     <li class="relative px-6 py-3">
       <button
         class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
         @click="togglePagesMenu"
         aria-haspopup="true"
       >
         <span class="inline-flex items-center">
            <i class="fa-solid fa-tools"></i>
           <span class="ml-4">Tools</span>
         </span>
         <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
           <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
             clip-rule="evenodd"
           ></path>
         </svg>
       </button>
       <template x-if="isPagesMenuOpen">
         <ul x-transition:enter="transition-all ease-in-out duration-300"
           x-transition:enter-start="opacity-25 max-h-0"
           x-transition:enter-end="opacity-100 max-h-xl"
           x-transition:leave="transition-all ease-in-out duration-300"
           x-transition:leave-start="opacity-100 max-h-xl"
           x-transition:leave-end="opacity-0 max-h-0"
           class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
           aria-label="submenu"
         >
           <li
             class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
             {{ request()->routeIs('role.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
           >
             <a class="w-full" href="{{ route('role.index') }}">Roles & Permissions</a>
           </li>
         </ul>
       </template>
     </li>
   </ul>
 </div>
</aside>
<!-- Mobile sidebar -->
<!-- Backdrop -->
<div
 x-show="isSideMenuOpen"
 x-transition:enter="transition ease-in-out duration-150"
 x-transition:enter-start="opacity-0"
 x-transition:enter-end="opacity-100"
 x-transition:leave="transition ease-in-out duration-150"
 x-transition:leave-start="opacity-100"
 x-transition:leave-end="opacity-0"
 class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
></div>
<aside
 class="fixed inset-y-0 z-20 flex-shrink-0 w-56 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
 x-show="isSideMenuOpen"
 x-transition:enter="transition ease-in-out duration-150"
 x-transition:enter-start="opacity-0 transform -translate-x-20"
 x-transition:enter-end="opacity-100"
 x-transition:leave="transition ease-in-out duration-150"
 x-transition:leave-start="opacity-100"
 x-transition:leave-end="opacity-0 transform -translate-x-20"
 @click.away="closeSideMenu"
 @keydown.escape="closeSideMenu"
>
 <div class="py-4 text-gray-500 dark:text-gray-400">
   <a
     class="inline-flex items-center ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
     href="#"
   >
   <img src="{{asset('img/logo.png') }}"/>

   </a>
   <ul class="mt-6">
    <li class="relative px-6 py-3">
        <span
        class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
        aria-hidden="true"
        ></span>
        <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
        {{ request()->routeIs('dashboard') ? ' text-gray-800 dark:text-gray-100' : '' }}"
        href="{{ route('dashboard') }}"
        >
        <i class="fa-solid fa-dashboard"></i>
        <span class="ml-4">Dashboard</span>
     </a>
 </li>
 <li class="relative px-6 py-3">
   <a
     class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
     href="{{ route('home') }}"
   >
   <i class="fa-solid fa-home"></i>
     <span class="ml-4">Visit Site</span>
   </a>
 </li>
</ul>
<ul>
    <li class="relative px-6 py-3">
        <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
        {{ request()->routeIs('account.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
        href="{{ route('account.index') }}"
      >
       <i class="fa-solid fa-thumb-tack"></i>
        <span class="ml-4">Accounts</span>
      </a>
    </li>
    <li class="relative px-6 py-3">
       <a
         class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
         {{ request()->routeIs('transaction.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
         href="{{ route('transaction.index') }}"
       >
         <i class="fa-solid fa-wallet"></i>
         <span class="ml-4">Transactions</span>
       </a>
     </li>
    <li class="relative px-6 py-3">
      <a href="{{ route('user.index') }}"
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
        {{ request()->routeIs('user.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
      >
      <i class="fa-solid fa-user"></i>
        <span class="ml-4">Users</span>
      </a>
    </li>

    <li class="relative px-6 py-3">
      <button
        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        @click="togglePagesMenu"
        aria-haspopup="true"
      >
        <span class="inline-flex items-center">
           <i class="fa-solid fa-tools"></i>
          <span class="ml-4">Tools</span>
        </span>
        <svg
          class="w-4 h-4"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <template x-if="isPagesMenuOpen">
        <ul
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-25 max-h-0"
          x-transition:enter-end="opacity-100 max-h-xl"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-xl"
          x-transition:leave-end="opacity-0 max-h-0"
          class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
          aria-label="submenu"
        >
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
            {{ request()->routeIs('role.index') ? ' text-gray-800 dark:text-gray-100' : '' }}"
          >
            <a class="w-full" href="{{ route('role.index') }}">Roles & Permissions</a>
          </li>

        </ul>
      </template>
    </li>
  </ul>

 </div>
</aside>
