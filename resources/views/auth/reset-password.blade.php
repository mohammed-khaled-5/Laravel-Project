<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Update Password</h2>
      <p class="mb-4">Choose a new secure password</p>
    </header>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="mb-6">
    <label for="email" class="inline-block text-lg mb-2">Email Address</label>
    <input 
        type="email" 
        name="email" 
        class="border border-gray-200 rounded p-2 w-full" 
        value="{{ request()->email }}" 
        readonly 
    />
    
    @error('email')
      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
    @enderror
</div>

      <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">New Password</label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
        
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password_confirmation" class="inline-block text-lg mb-2">Confirm New Password</label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
      </div>

      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Reset Password
        </button>
      </div>
    </form>
  </x-card>
</x-layout>