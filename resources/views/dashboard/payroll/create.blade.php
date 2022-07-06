<x-app-layout>

    <!--Heading-->
    <x-slot name="header">
    </x-slot>
    <!-- Grid -->
    <div class="grid grid-cols-1">
         <!--Form-->
         <div class="flex justify-center w-full">
          <div class="">
            <div class="">
              <div class="bg-white">
                <h1 class="text-lg text-left p-3 font-bold text-gray-800">
                    Add Payroll Item
                </h1>
                <div class="mx-auto px-4 py-10">
                    <form class="w-full" action="{{ route('payroll.store') }}" method="POST">
                        @csrf
                        <!--Row one-->
                        <div class="flex flex-wrap -mx-2 mb-6">
                                <!--Staff No.-->
                            <div class="w-full md:w-1/3  px-1 mb-6 md:mb-0">
                                <x-label for="Staff No." :value="__('Staff No.')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <x-input id="staff" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="staff_no" required autofocus />
                            </div>
                            <!--Name of Employee-->
                            <div class="w-full md:w-1/3 px-1">
                                <x-label for="Name of Employee" :value="__('Name of Employee')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <x-input id="employee_name" class="mt-1 w-full sm:w-12/12" type="text" name="employee_name" required autofocus />
                            </div>
                            <!--Grade/Post-->
                            <div class="w-full md:w-1/3 px-1">
                                <x-label for="Grade" :value="__('Grade/Post')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                                <x-input id="grade" class="mt-1 w-full sm:w-12/12" type="text" name="grade" required autofocus />
                            </div>
                        </div>
                        <!--Row one-->
                        <div class="flex flex-wrap -mx-2 mb-6">
                            <!--Empolyee TIN-->
                          <div class="w-full md:w-1/3  px-1 mb-6 md:mb-0">
                            <x-label for="Empolyee TIN" :value="__('Empolyee TIN')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="tin_no" class="mt-1 w-full sm:w-12/12" type="text" name="tin_no" required autofocus />
                          </div>
                          <!--Basic Salary Paid-->
                          <div class="w-full md:w-1/3 px-1">
                            <x-label for="Salary" :value="__('Basic Salary Paid')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="salary" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="salary" required autofocus />
                        </div>
                        <!---->
                        <div class="w-full md:w-1/3 px-1">
                            <x-label for="allowance" :value="__('Cash Allowance')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="cash_allowance" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="cash_allowance" required autofocus />
                        </div>
                        </div>
                        <!--Row one-->
                        <div class="flex flex-wrap -mx-2 mb-6">
                            <!---->
                          <div class="w-full md:w-1/3  px-1 mb-6 md:mb-0">
                            <x-label for="vehicle_element" :value="__('Vehicle Element')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="vehicle_element" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="vehicle_element" required autofocus />
                          </div>
                          <!---->
                          <div class="w-full md:w-1/3 px-1">
                            <x-label for="accomadation" :value="__('Accomadation Element')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="accomadation" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="accomadation" required autofocus />
                        </div>
                        <!---->
                        <div class="w-full md:w-1/3 px-1">
                            <x-label for="benefits" :value="__('Other Benefits')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="benefits" class="mt-1 w-full sm:w-12/12" type="number" name="benefits" step="any" required autofocus />
                        </div>
                        </div>
                        <!--Row one-->
                        <div class="flex flex-wrap -mx-2 mb-6">
                          <!---->
                          <div class="w-full md:w-1/3 px-1">
                            <x-label for="social_security" :value="__('Social Security Deductions')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="social_security" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="social_security" required autofocus />
                        </div>
                        <!---->
                        <div class="w-full md:w-1/3 px-1">
                            <x-label for="deductable_relief" :value="__('Deductable Relief')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="deductable_relief" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="deductable_relief" required autofocus />
                        </div>
                        <!--Tax Deductable-->
                        <div class="w-full md:w-1/3 px-1">
                          <x-label for="tax_deductable" :value="__('Tax Deductable')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                          <x-input id="tax_deductable" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="tax_deductable" required autofocus />
                      </div>
                        </div>
                        <!--Row three-->
                        <div class="flex flex-wrap -mx-2 mb-6">
                        <!---->
                        <div class="w-full md:w-1/3 px-1">
                            <x-label for="tax_paid_GRA" :value="__('Tax Dedected & Paid to GRA')" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
                            <x-input id="tax_paid_GRA" class="mt-1 w-full sm:w-12/12" type="number" step="any" name="tax_paid_GRA" required autofocus />
                        </div>
                        </div>
                        <!--Button-->
                        <div class="left-0 right-0 mt-5">
                            <div class="max-w-5xl mx-auto p-3">
                                <div class="flex">
                                    <div class="w-1/2">
                                        <button type="submit"
                                            class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
                                            focus:shadow-lg focus:outline-none focus:ring-0">
                                        Finish
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
