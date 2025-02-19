<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Image Section -->
            <div class="w-full md:w-1/2 p-4">
                <img src="{{ asset('images/about-us.jpeg') }}" alt="About Us" class="w-full rounded-lg shadow-lg">
            </div>
            <!-- Text Section -->
            <div class="w-full md:w-1/2 p-4">
                <h3 class="text-2xl font-bold mb-4">Our Story</h3>
                <p class="text-gray-700 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. 
                    Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
                </p>
                <p class="text-gray-700">
                    Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. 
                    Vestibulum lacinia arcu eget nulla. 
                </p>
                <p class="text-gray-700 mt-4">
                    Our mission is to provide exceptional service and deliver outstanding results for our clients, while fostering a collaborative environment that drives innovation and growth.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
