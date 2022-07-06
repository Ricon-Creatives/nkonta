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
                  <h1 class="text-lg text-center p-3 font-bold text-gray-800">
                      Add Purchase
                  </h1>
                <div class="mx-auto px-4 py-10">
                    <form class="w-full" action="{{ route('purchases.store') }}" method="POST">
                        @csrf

                        <div class="flex flex-wrap -mx-2 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-label for="Name" :value="__('Name')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="name" class="mt-1 w-full sm:w-9/12" type="text" name="name" required autofocus />
                          </div>
                          <div class="w-full md:w-1/2 px-3">
                            <x-label for="address" :value="__('Contact Address')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="address" class="mt-1 w-full sm:w-9/12" type="text" name="address" required autofocus />
                        </div>
                        </div>
                        <div class="flex flex-wrap -mx-2 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="contact_no" :value="__('Contact No.')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <x-input id="contact_no" class="block mt-1 w-9/12" type="tel" name="contact_no"
                                placeholder="eg. 233501234567" required autofocus pattern="[0-3]{3}[0-9]{3}[0-9]{3}[0-9]{3}" required autofocus />
                            </div>
                              <div class="w-full md:w-1/2 px-3">
                                <x-label for="contact_person" :value="__('Contact Person')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <x-input id="contact_person" class="block mt-1 w-9/12" type="text" name="contact_person" required autofocus />
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-2 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="due_date" :value="__('Due Date  (in days)')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <x-input id="due_date" class="block mt-1 w-9/12" type="number" name="due_date" step="any" required autofocus />
                            </div>

                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-label for="vat" :value="__('VAT')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                             <x-input id="vat" class="block mt-1 w-9/12" type="number" name="vat"  step="any" required autofocus />
                          </div>
                        </div>
                          <div class="flex flex-wrap -mx-2 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 hidden">
                            <x-label for="account" :value="__('Type')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"/>
                            <div class="flex w-9/12 mt-1">
                               <select class="form-select appearance-none block py-1.5 text-base font-normal text-gray-600
                               bg-white bg-no-repeat transition ease-in-out m-0
                               focus:text-gray-600 focus:bg-white focus:outline-none" name="type" id="type" required>
                                 <option disabled>Select Type</option>
                                 <option value="expense" selected>Buying</option>
                                 <option value="income" disabled>Selling</option>
                             </select>
                             </div>
                          </div>
                        </div>
                        <!--Button-->
                        <div class="left-0 right-0 mt-5">
                            <div class="max-w-3xl mx-auto p-4">
                                <div class="flex md:justify-between">
                                    <div class="w-1/2">
                                        <button type="submit"
                                            class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
                                            focus:shadow-lg focus:outline-none focus:ring-0">
                                        Next
                                    </button>
                                    </div>
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
    </div>
  </x-app-layout>
