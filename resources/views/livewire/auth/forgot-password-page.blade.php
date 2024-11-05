<div class="min-h-screen flex flex-col">
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h1 class="text-4xl font-light">Forgot password?</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Remember your password?
                    <a href="/login" class="font-medium text-black hover:underline">Sign in</a>
                </p>
            </div>
            <form class="mt-8 space-y-6" wire:submit.prevent='save'>
                @if (session('success'))
                    <div class="rounded-lg bg-green-50 p-4 text-sm text-green-700" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <input id="email" name="email" type="email" wire:model="email" required
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-3 px-4 focus:outline-none focus:ring-black focus:border-black sm:text-sm">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" class="main-button w-full">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
