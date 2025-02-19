<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="relative bg-cover bg-center h-[500px] flex items-center justify-center" style="background-image: url('{{ asset('images/home-bg12.jpg') }}');">
        <div class="bg-black bg-opacity-50 p-6 rounded-lg text-white text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Our Platform</h1>
            <p class="text-lg">Explore amazing features and start your journey with us.</p>
        </div>
    </div>

</x-app-layout>
