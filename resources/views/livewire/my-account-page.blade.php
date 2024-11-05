<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h2 class="mb-6">My Account</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 inline-block min-w-full sm:min-w-0">
        <div class="flex flex-col sm:flex-row sm:space-x-12 lg:space-x-24">
            <div class="mb-4 sm:mb-0">
                <h5 class="mb-2">Personal Information</h5>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
            <div>
                <h5 class="mb-2">Account Details</h5>
                <p><strong>Registered on:</strong> {{ $user->created_at->format('F d, Y') }}</p>
                <p><strong>Total Orders:</strong> {{ $user->orders->count() }}</p>
            </div>
        </div>
    </div>
</div>
