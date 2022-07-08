@if(session()->has('message'))
<div class="absolute right-0 p-1">
    <div class="flex items-center px-4 py-4 rounded  text-slate-800 bg-slate-300" role="alert">
        <p>{{ session()->get('message') }}</p>
    </div>
  </div>
@endif
<x-app-layout>
    <!-- Grid -->
    <div class="grid grid-cols-1">

      <!--Heading-->
   <x-slot name="header">
    </x-slot>

    <!--Form-->
    <div class="flex flex-col px-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block sm:min-w-md min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white">
                <div class="mx-auto px-4 py-10">
                <form class="w-full" action="{{ route('item.store') }}" method="Post">
                    @csrf

                    <div class="flex flex-wrap -mx-2 mb-5">
                        <div class="w-full md:w-1/2 px-1 mb-6 md:mb-0">
                            @if($title->type == 'Selling')
                          <x-label for="Name" :value="__('Customer Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                          <h6> {{ $title->name }} </h6>
                          <a href="{{ route('sales.create') }}" class="underline text-sm text-blue-600 hover:text-blue-900 mt-3">
                             Change
                            </a>
                            @else
                            <x-label for="Name" :value="__('Buyer\'s Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                          <h6> {{ $title->name }} </h6>
                          <a href="{{ route('sales.create') }}" class="underline text-sm text-blue-600 hover:text-blue-900 mt-3">
                             Change
                            </a>

                            @endif
                         </div>

                      </div>

                      <!--Item Name & Quantity-->
                    <div class="flex flex-wrap -mx-2 mb-6">
                        <div class="w-full md:w-1/2 px-3">
                            <x-label for="address" :value="__('Item Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input  class="block w-full sm:w-9/12" type="text" name="item_name" required autofocus />
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-label for="contact_no" :value="__('Quantity')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input  class="block w-full sm:w-9/12" type="number" name="qty" required autofocus />
                        </div>
                    </div>

                    <!--Price & Discount-->
                    <div class="flex flex-wrap -mx-2 mb-6">
                          <div class="w-full md:w-1/2 px-3">
                            <x-label for="price" :value="__('Price')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input  class="block w-full sm:w-9/12" type="number" name="price"  step="any" required autofocus />
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-label for="due_date" :value="__('Discount')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input   class="block w-full sm:w-9/12" type="number" name="discount" autofocus />
                        </div>
                    </div>

                    <!--Accounts-->
                    <div class="flex flex-wrap -mx-2 mb-6">
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <x-label for="account" :value="__('Account To Debit')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"/>
                        <div class="flex w-9/12 mt-1">
                           <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                           bg-white bg-no-repeat transition ease-in-out m-0
                           focus:text-gray-600 focus:bg-white focus:outline-none" name="acc_dr" id="type" required>
                           <option selected>Select Account</option>
                           @foreach($accounts as $account)
                           <option value="{{$account->id}}">{{$account->name}}</option>
                           @endforeach
                         </select>
                         </div>
                      </div>
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-label for="account" :value="__('Account To Credit')" class="block uppercase tracking-wnamee text-gray-700 text-xs font-bold mb-2"/>
                            <div class="flex w-9/12 mt-1">
                               <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                               bg-white bg-no-repeat transition ease-in-out m-0
                               focus:text-gray-600 focus:bg-white focus:outline-none" name="acc_cr" required>
                               <option selected>Select Account</option>
                               @foreach($accounts as $account)
                               <option value="{{$account->id}}">{{$account->name}}</option>
                               @endforeach
                             </select>
                             </div>
                      </div>
                    </div>

                      <!--Button-->
                      <div class="left-0 right-0 mt-5">
                        <div class="max-w-3xl mx-auto p-4">
                            <div class="flex md:justify-between">
                                <div class="w-1/2">
                                    <button type="submit" name="next" value="Next"
                                        class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
                                        focus:shadow-lg focus:outline-none focus:ring-0">
                                    Next
                                </button>
                                </div>


                                    <button type="submit" name="complete"  value="Complete"
                                        class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-green-600 hover:shadow-lg
                                        focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out"
                                    >Complete</button>
                                </div>
                            </div>
                        </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
    </div>

    </div>
</x-app-layout>
