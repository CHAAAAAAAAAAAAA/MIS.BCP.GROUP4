<x-admin-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Edit Admin Profile') }}
      </h2>
  </x-slot>

  @if (session('status'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
        {{ session('status') }}
    </div>
  @endif
  
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
          <!-- Profile Form -->
          <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
              <form method="POST" action="{{ route('profile.adminupdate') }}">
                  @csrf
                  @method('PATCH')

                  <!-- Name -->
                  <div>
                      <x-input-label for="name" :value="__('Name')" />
                      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                                    value="{{ old('name', $admin->name) }}" required autofocus autocomplete="name" />
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>

                  <!-- Email Address -->
                  <div class="mt-4">
                      <x-input-label for="email" :value="__('Email')" />
                      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
                                    value="{{ old('email', $admin->email) }}" required autocomplete="email" />
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>

                  <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                      {{ __('Update Profile') }}
                  </button>
              </form>
          </div>

          <!-- Change Password Form -->
          <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
              <form method="POST" action="{{ route('profile.adminpasswordupdate') }}">
                  @csrf
                  @method('PATCH')

                  <!-- Current Password -->
                  <div>
                      <x-input-label for="current_password" :value="__('Current Password')" />
                      <x-text-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required autocomplete="current-password" />
                      <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                  </div>

                  <!-- New Password -->
                  <div class="mt-4">
                      <x-input-label for="password" :value="__('New Password')" />
                      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>

                  <!-- Confirm New Password -->
                  <div class="mt-4">
                      <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                      <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>

                  <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                      {{ __('Change Password') }}
                  </button>
              </form>
          </div>

        <!-- Delete Account Form -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <form method="POST" action="{{ route('profile.admindelete') }}">
              @csrf
              @method('DELETE')

              <p class="text-red-600">
                  {{ __('Once you delete your account, all of its data will be permanently removed. Please ensure this is what you want to do.') }}
              </p>

              <!-- Password Confirmation -->
              <div class="mt-4">
                  <x-input-label for="password" :value="__('Password')" />
                  <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

              <button type="submit" class="mt-4 px-4 py-2 bg-red-600 text-white rounded">
                  {{ __('Delete Account') }}
              </button>
          </form>
        </div>
      </div>
  </div>
</x-admin-layout>