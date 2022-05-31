<x-guest-layout>
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8 bg-white shadow-sm">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
          <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
            <div class="flex items-center justify-between w-full md:w-auto">
              <a href="/">
                <span class="sr-only">Nkonta</span>
                <img src="{{asset('img/logo-01.png') }}" class="h-20 w-auto" />
            </a>
            </div>
          </div>
          <div class="md:block md:ml-10 md:pr-4 md:space-x-8">

            @if (Route::has('login'))

        @auth
            <a href="{{ url('/home') }}" class="text-gray-500 font-medium dark:text-gray-500">Home</a>
        @else
        @endauth
            <a href="{{ url('/pricing') }}" class="text-gray-500 font-medium dark:text-gray-500">Pricing</a>
          @guest
            <a href="{{ route('login') }}" class="ml-4 text-gray-500 font-medium dark:text-gray-500">Log in</a>
           @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-gray-500 font-medium dark:text-gray-500">Register</a>
           @endif
          @endguest
         @endif

          </div>
        </nav>
      </div>
<!-- ====== Pricing Section Start -->
<section
class="flex md:flex-row items-center justify-center md:px-4 py-9"
>
<div class="grid grid-cols-1 md:grid-cols-5">
<!--Small-->
<article class="w-72 md:w-64 m-2">
    <div class="rounded shadow p-4 bg-white">
    <p class="text-2xl leading-normal text-center font-bold text-black dark:text-white pt-4">
        Small
    </p>
    <p class="text-5xl font-inter leading-normal text-center font-bold text-black dark:text-white pb-4">
        <span class="font-inter text-lg leading-loose text-center font-medium text-black  dark:text-white uppercase">
            GH&#8373;
        </span>
        70
        <small class="text-base text-gray-700">
            /mo
        </small>
    </p>
    <ul>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            No. User License - 1
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Transactions <br>(Sales, Purchases, Revenue, Expense)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Dashboard - 10
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Reporting - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Ratio - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Tax Returns <br>(Including VAT, COVID, NHIS, eLevy, Talk Tax)
        </li>
    </ul>
    <div class="py-4 text-center">
        <button type="button" class="uppercase inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
     Subscribe
      </button>
    </div>
    </div>
</article>

<!--Medium-->
<article class="w-72 md:w-64 m-2">
    <div class="rounded shadow p-4 bg-white">

    <p class="text-2xl leading-normal text-center font-bold text-black dark:text-white pt-4">
       Medium
    </p>
    <p class="text-5xl font-inter leading-normal text-center font-bold text-black dark:text-white pb-4">
        <span class="font-inter text-base leading-loose text-center font-medium text-black  dark:text-white uppercase">
            GH&#8373;
        </span>
        130
        <small class="text-base text-gray-700">
            /mo
        </small>
    </p>
    <ul>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            No. User License - 1
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Transactions <br>(Sales, Purchases, Revenue, Expense)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Dashboard - 10
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Reporting - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Ratio - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Tax Returns <br>(Including VAT, COVID, NHIS, eLevy, Talk Tax)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            PAYE
        </li>
    </ul>
    <div class="py-4 text-center">
        <button type="button" class="uppercase inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
     Subscribe
      </button>
    </div>
    </div>
</article>

<!-- Enterprise-->
<article class="w-72 md:w-64 m-2">
    <div class="rounded shadow p-4 bg-white">
    <p class="text-2xl leading-normal text-center font-bold text-black dark:text-white pt-4">
        Enterprise
    </p>
    <p class="text-5xl font-inter leading-normal text-center font-bold text-black dark:text-white pb-4">
        <span class="font-inter text-base leading-loose text-center font-medium text-black  dark:text-white uppercase">
            GH&#8373;
        </span>
        19
        <small class="text-base text-gray-700">
            /mo
        </small>
    </p>
    <ul>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            No. User License - 1
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Transactions <br>(Sales, Purchases, Revenue, Expense)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Dashboard - 10
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Reporting - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Ratio - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Tax Returns <br>(Including VAT, COVID, NHIS, eLevy, Talk Tax)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            PAYE
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Payroll
        </li>
    </ul>
    <div class="py-4 text-center">
        <button type="button" class="uppercase inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
     Subscribe
      </button>
    </div>
    </div>
</article>

<!-- Enterprise Plus-->
<article class="w-72 md:w-64 m-2">
    <div class="rounded shadow p-4 bg-white">
    <p class="text-2xl leading-normal text-center font-bold text-black dark:text-white pt-4">
       Enterprise Plus
    </p>
    <p class="text-5xl font-inter leading-normal text-center font-bold text-black dark:text-white pb-4">
        <span class="font-inter text-base leading-loose text-center font-medium text-black  dark:text-white uppercase">
            GH&#8373;
        </span>
       450
        <small class="text-base text-gray-700">
            /mo
        </small>
    </p>
    <ul>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            No. User License - 1
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Transactions <br>(Sales, Purchases, Revenue, Expense)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Dashboard - 10
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Reporting - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Financial Ratio - 4
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Tax Returns <br>(Including VAT, COVID, NHIS, eLevy, Talk Tax)
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            PAYE
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3 border-t border-gray-300">
            Payroll
        </li>
    </ul>
    <div class="py-4 text-center">
        <button type="button" class="uppercase inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
     Subscribe
      </button>
    </div>
    </div>
</article>

<!--Group-->
<article class="w-72 md:w-64 m-2">
    <div class="rounded shadow p-4 bg-white">
    <p class="text-2xl leading-normal text-center font-bold text-black dark:text-white pt-4">
        Group
    </p>
    <p class="text-5xl font-inter leading-normal text-center font-bold text-black dark:text-white pb-4">
        <span class="font-inter text-base leading-loose text-center font-medium text-black dark:text-white uppercase">

        </span>
        <small class="text-base text-gray-700">
            /mo
        </small>
    </p>
    <ul>
        <li class="text-lg font-inter leading-normal text-center font-bold text-black dark:text-white py-3 border-t border-gray-300">
            50% Discount
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3">
            for selected model for each member
        </li>
        <li class="text-sm font-inter leading-normal text-center font-medium text-black dark:text-white py-3">
            For groups above 10 members
        </li>
    </ul>
    <div class="py-4 text-center">
        <button type="button" class="uppercase inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
     Subscribe
      </button>
    </div>
    </div>
</article>

</div>
</section>
<!-- ====== Pricing Section End -->
</x-guest-layout>
