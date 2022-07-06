<x-app-layout>
    <!--Heading-->
    <x-slot name="header">
    </x-slot>
    <div class="flex justify-between p-3">
        <!-- Link -->
     <a  href="{{ route('payroll.create') }}" type="button" class="inline-block px-6 py-2.5 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
     focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
     Add New
     </a>
    <div class="flex justify-end ">
     <!-- Date Range
     <form method="POST" action="{{ route('search.payroll') }}">
        @csrf
     <div class="hidden sm:flex sm:items-center sm:justify-between justify-center w-full">
             <x-input id="to" class="w-full py-1.5 rounded-none" type="date" name="to_month"
             :value="old('to_month')" required  />
         <x-button class="mr-3">
             Search
         </x-button>
     </div>
 </form>-->
    <!-- Link -->
    <a  href="{{ route('payroll.submit') }}" type="button" class="inline-block px-6 py-2.5 mr-3 bg-purple-900 text-white font-medium text-xs leading-tight rounded shadow-sm hover:bg-purple-700 hover:shadow-lg
    focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out">
    Submit
    </a>
      <!-- Exports-->
     <div x-data="{ show: false }"  @click.away="show = false" class="inline-block text-left mr-2">
        <button @click="show = ! show" type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-white bg-purple-900 text-sm font-medium focus:outline-none
        focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 leading-tight">
        Export
        <svg class="-mr-1 ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
    <div x-show="show" x-transition x-cloak class="absolute bg-white z-10 shadow-md w-32">
        <a  href="#" onclick="generatePpagePDF('pdf-report','Payroll')" class="text-gray-700 block px-4 py-2 text-sm">
            PDF
           </a>
</div>
</div>
    </div>
 </div>
    <div class="grid grid-cols-1 bg-white" id="pdf-report">
         <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 bg-white p-2">
        <div class="p-2 items-center">
            <ul class="list-none p-3 font-medium" style="list-style: none;float:left;">
                <li>Employers TIN/FILe No.</li>
                <li>Name of Employers</li>
                <li>Address of Employers</li>
                <li>Postal Address</li>
                <li>Email</li>
                <li>Digital Address</li>
                <li>Tel. No.</li>
              </ul>
        </div>

        <!-- ... -->
        <div class="p-2 items-center justify-end" style="float:right;top:0px;">
            <ul class="list-none p-3 font-medium" style="list-style: none;">
                <!--  -->
                <li>GHANA REVENUE AUTHORITY</li>
                <li>DOMESTIC TAX REVENUE DIVISION</li>
                <li>EMPLOYER'S SCHEDULE OF MONTHL TAX DEDUCTIONS (PAYE)</li>
              </ul>
              <ul class="list-none p-3 font-medium" style="list-style: none;">
                <li>FOR THE MONTH OF {{!empty($results) ? \Carbon\Carbon::parse($results['to_month'])->format('M-Y')
                    : \Carbon\Carbon::today()->format('M-Y') }}
                    </li>
              </ul>
        </div>
        <!-- ... -->
      </div>
     <!-- Grid -->

          <!--Table-->
          <div class="flex px-4 h-screen">
           <div class="overflow-x-auto sm:-mx-4 lg:-mx-6">
             <div class="py-2 inline-block min-w-full sm:px-4 lg:px-6">
               <div class="overflow-hidden">
                 <table class="min-w-full" id="balSheet">
                   <thead class="bg-white border-b border-gray-300">
                     <tr>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Staff No.
                       </th>
                         <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                            Name of Employee
                           </th>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Grade/Post
                       </th>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Empolyee TIN
                       </th>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Basic Salary Paid
                       </th>
                         <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                            Cash Allowance
                           </th>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Vehicle Element
                       </th>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Accomadation Element
                       </th>
                       <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Other Benefits
                       </th>
                   <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                    Total Emoluments
                   </th>
                   <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                    Social Security Deductions
                   </th>
                   <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                    Deductable Relief
                   </th>
                     <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                        Net Taxable Pay
                       </th>
                   <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                    Tax Deductable
                   </th>
                   <th scope="col" class="text-xs font-bold text-gray-900 px-2 py-2 text-center">
                    Tax Deducted & Paid to GRA
                   </th>
                   </tr>
                   </thead>
                   <tbody>
                    @foreach ($data as $payroll)

                    <tr class="bg-white border-b">
                        <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ $payroll->staff_no }}
                        </td>
                      <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                        {{ $payroll->employee_name }}
                    </td>
                    <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900  text-center">
                        {{ $payroll->grade }}
                    </td>
                    <td scope="col" class="text-sm font-medium text-gray-900  py-2 text-center">
                        {{ $payroll->tin_no }}
                    </td>
                    <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                        {{number_format( $payroll->salary,2) }}
                    </td>
                  <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                    {{number_format($payroll->cash_allowance,2) }}
                </td>
                <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900  text-center">
                    {{number_format($payroll->vehicle_element,2) }}
                </td>
                <td scope="col" class="text-sm font-medium text-gray-900  py-2 text-center">
                    {{number_format($payroll->accomadation,2) }}
                </td>
                <td scope="col" class="text-sm font-medium text-gray-900  py-2 text-center">
                    {{number_format($payroll->benefits,2) }}
                </td>
                <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                    {{number_format($payroll->total_emoluments,2) }}
                </td>
              <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                {{number_format($payroll->social_security,2) }}
            </td>
            <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900  text-center">
                {{number_format($payroll->deductable_relief,2) }}
            </td>
            <td scope="col" class="text-sm font-medium text-gray-900  py-2 text-center">
                {{number_format($payroll->net_taxable_pay,2) }}
            </td>
            <td scope="col" class="text-sm font-medium text-gray-900  py-2 text-center">
                {{number_format($payroll->tax_deductable,2) }}
            </td>
            <td class=" py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                {{number_format($payroll->tax_paid_GRA,2) }}
            </td>
                    </tr>
                    @endforeach

                   </tbody>
                 </table>
               </div>
               <!---->
               <div class="py-4 items-center max-w-xs">
                <ul class="list-none p-3 font-medium" style="list-style: none">
                    <li class="border-b border-gray-300">Date</li>
                    <li class="order-b border-gray-300">Submitted by</li>
                    <li class="border-b border-gray-300">Designation</li>
                  </ul>
            </div>
             </div>
           </div>
         </div>
    </div>
   </x-app-layout>
