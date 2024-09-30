<!-- resources/views/partials/nav.blade.php -->
<nav class="fixed inset-x-0 bottom-0 flex justify-center p-4 z-50">
    <div class="flex space-x-2 bg-gray-200/80 rounded-full p-1">
        <a href="{{ route('work') }}"
            class="px-6 py-2 rounded-full text-lg font-medium transition-colors duration-200 {{ request()->routeIs('work') ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-300/50' }}">
            Work
        </a>
        <a href="{{ route('contact') }}"
            class="px-6 py-2 rounded-full text-lg font-medium transition-colors duration-200 {{ request()->routeIs('contact') ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-300/50' }}">
            Contact
        </a>
        <a href="{{ route('store') }}"
            class="px-6 py-2 rounded-full text-lg font-medium transition-colors duration-200 {{ request()->routeIs('store') ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-300/50' }}">
            Store
        </a>
        <a href="{{ route('cart') }}"
            class="px-6 py-2 rounded-full text-lg font-medium transition-colors duration-200 {{ request()->routeIs('cart') ? 'bg-black text-white' : 'text-gray-700 hover:bg-gray-300/50' }}">
            Cart
        </a>
    </div>
</nav>
