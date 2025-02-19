<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-4 md:px-16">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <!-- Contact Info -->
            <div class="w-full md:w-1/2">
                <h3 class="text-2xl font-bold mb-4">Get in Touch</h3>
                <p class="text-gray-700 mb-4">
                    Have any questions? We'd love to hear from you. Reach out using the form or contact us directly.
                </p>
                <div class="mt-4 space-y-3">
                    <p class="flex items-center">
                        📍 <span class="ml-2">123 Street, Ahmedabad, Bharat</span>
                    </p>
                    <p class="flex items-center">
                        📞 <span class="ml-2">+123 456 7890</span>
                    </p>
                    <p class="flex items-center">
                        ✉️ <span class="ml-2">conact@myblog.com</span>
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="w-full md:w-1/2 bg-white shadow-lg rounded-lg p-6">
                <form action="" >
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Your Name</label>
                        <input type="text" name="name" class="w-full mt-1 p-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Your Email</label>
                        <input type="email" name="email" class="w-full mt-1 p-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Message</label>
                        <textarea name="message" rows="4" class="w-full mt-1 p-2 border rounded-lg" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
