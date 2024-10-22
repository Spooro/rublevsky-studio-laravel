<div class="min-h-screen flex flex-col">
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h1 class="text-4xl font-light">Sign in</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Don't have an account yet?
                    <a href="/register" class="font-medium text-black hover:underline">Sign up</a>
                </p>
            </div>
            <form class="mt-8 space-y-6" wire:submit.prevent='save'>
                @if (session('error'))
                    <div class="rounded-lg bg-red-50 p-4 text-sm text-red-700" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" wire:model="email" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-black focus:border-black sm:text-sm">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" wire:model="password" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-black focus:border-black sm:text-sm">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="/forgot" class="font-medium text-gray-600 hover:text-black">Forgot password?</a>
                    </div>
                </div>
                <div>
                    <button type="submit" class="main-button w-full">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </main>

</div>
