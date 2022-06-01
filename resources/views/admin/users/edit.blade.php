@extends('admin.layouts.index')
@section('main')

<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('user.update',$user->id) }}" enctype="form/html" method="POST">
    @method('PUT')
    @csrf

    <div class="flex flex-wrap mb-5">
    <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Name</span>
        <input type="text"
          class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Name" name="name" value="{{ $user->name }}"
        />
      </label>
    </div>
    <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Username</span>
        <input type="text"
          class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="username" name="username" value="{{ old('username') ?? $user->username }}"
        />
      </label>
    </div>
    </div>
    <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input type="text"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Email" name="email" value="{{old('email') ?? $user->email }}"
            />
          </label>
        </div>
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Phone</span>
            <input type="text"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Phone" name="phone" value="{{ old('phone') ?? $user->phone }}" pattern="[0-3]{3}[0-9]{3}[0-9]{3}[0-9]{3}"
            />
          </label>
        </div>
    </div>
    <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Company Name</span>
            <input type="text"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Company Name" name="company_name" value="{{ $user->company_name }}"
            />
          </label>
        </div>
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Role
                </span>
                <select name="role"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                 >
                 <option value="" class="text-gray-600 bg-gray-400">Assign Role</option>
                 @foreach($roles as $role)
                 <option value="{{$role->name}}"> {{$role->name}} </option>
                 @endforeach
                </select>
              </label>

        </div>
     </div>

     <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input type="password"
              class="block w-full sm:w-9/12 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
              placeholder="Password" name="password"
            />
          </label>
        </div>

     </div>

     <div class="mt-4 p-4">
        <button type="submit"
        class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded
        active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Update
        </button>

     </div>
</form>

</div>

<div
class="px-4 py-3 mt-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 w-5/12"
>
<form action="{{ route('account.status', $user->id) }}" enctype="form/html" method="POST">
    @method('PUT')
    @csrf

    <!--Locked-->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Security
      </h4>
      <div class="flex flex-wrap mb-5">
        <div class="w-full md:w-1/2 px-2 mb-6 md:mb-0">
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Account Status
                </span>
                <select name="locked"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                required>
                <option value="locked" {{($user->locked) ? 'selected= selected' : '' }}>Locked</option>
                <option value="active" {{($user->locked == "") ? 'selected= selected' : '' }}>Active</option>
                </select>
              </label>
        </div>

     </div>

    <div class="mt-4 p-4">
        <button type="submit"
        class="px-4 py-2 font-medium leading-5 text-sm text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded
        active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Update
        </button>

     </div>
</form>
</div>
@endsection
