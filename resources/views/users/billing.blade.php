<x-layout>
    @if(request()->query('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    Payment Successful! Your account is now Premium.
                </div>
            @endif
    <div class="mx-4">
        <x-card class="p-10 max-w-4xl mx-auto mt-10">
            <header class="text-center mb-10">
                <h1 class="text-3xl font-bold uppercase mb-2">Upgrade Your Account</h1>
                <p class="text-gray-600 text-lg">Choose the plan that fits your business needs</p>
            </header>

            <div class="grid md:grid-cols-2 gap-8">
                <div
                    class="border border-gray-200 rounded-lg p-6 flex flex-col items-center relative {{ auth()->user()->plan == 'free' ? 'border-laravel border-2' : '' }}">
                    @if(auth()->user()->plan == 'free')
                        <span
                            class="absolute -top-3 bg-laravel text-white px-3 py-1 rounded-full text-xs uppercase font-bold">Current
                            Plan</span>
                    @endif

                    <h3 class="text-xl font-bold mb-4">Free Plan</h3>
                    <div class="text-4xl font-bold mb-6">$0 <span class="text-sm text-gray-500 font-normal">/
                            month</span></div>

                    <ul class="text-left space-y-3 mb-8 flex-grow">
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Post up to 2
                            Jobs</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Standard Job
                            Tags</li>
                        <li class="flex items-center text-gray-400"><i class="fa-solid fa-xmark mr-3"></i> No Featured
                            Posts</li>
                        <li class="flex items-center text-gray-400"><i class="fa-solid fa-xmark mr-3"></i> No Priority
                            Support</li>
                    </ul>

                    @if(auth()->user()->plan == 'free')
                        <button disabled
                            class="w-full bg-gray-300 text-white font-bold py-2 rounded cursor-not-allowed">Active</button>
                    @else
                        <a href="/"
                            class="w-full text-center border border-gray-300 font-bold py-2 rounded hover:bg-gray-50">Back
                            to Home</a>
                    @endif
                </div>

                <div
                    class="border border-gray-200 rounded-lg p-6 flex flex-col items-center bg-gray-50 relative {{ auth()->user()->plan == 'premium' ? 'border-laravel border-2' : '' }}">
                    @if(auth()->user()->plan == 'premium')
                        <span
                            class="absolute -top-3 bg-laravel text-white px-3 py-1 rounded-full text-xs uppercase font-bold">Current
                            Plan</span>
                    @endif

                    <h3 class="text-xl font-bold mb-4">Premium Plan</h3>
                    <div class="text-4xl font-bold mb-6 text-laravel">$19 <span
                            class="text-sm text-gray-500 font-normal">/ month</span></div>

                    <ul class="text-left space-y-3 mb-8 flex-grow">
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Unlimited
                            Job Posts</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Featured Job
                            Status</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Custom
                            Company Branding</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> 24/7
                            Priority Support</li>
                    </ul>

                    @if(auth()->user()->plan == 'premium')
                        <button disabled
                            class="w-full bg-gray-300 text-white font-bold py-2 rounded cursor-not-allowed">Active</button>
                    @else
                        <form action="{{ route('subscribe') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-laravel text-white font-bold py-2 rounded">
                                Upgrade to Premium
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="mt-10 text-center text-gray-500 text-sm">
                <p><i class="fa-solid fa-lock mr-2"></i> All payments are secured by Stripe</p>
            </div>


        </x-card>
    </div>
</x-layout>
