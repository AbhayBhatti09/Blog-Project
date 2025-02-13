<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ $data['title'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    @if(!empty($data['image']))
                        <img src="{{ asset('images/'.$data['image']) }}" alt="{{ $data['title'] }}" class="w-50 sm:w-1/2 md:w-3/4 lg:w-full h-50 object-cover rounded">
                    @else
                        <img src="{{ asset('storage/images/default.jpg') }}" alt="{{ $data['title'] }}" class="w-50 sm:w-1/2 md:w-3/4 lg:w-full h-50 object-cover rounded">
                    @endif
                </div>

                <h1 class="text-3xl font-bold mt-6">{{ $data['title'] }}</h1>
              


                <div class="mt-4 text-gray-800">
                    <p>{{ $data['content'] }}</p>
                </div>
                <p class="text-lg text-gray-600 mt-2">Publish on: {{ $data['author_name'] }} , {{$data['created_at']->format('Y-m-d h:m A')}} </p>


                <div class="mt-6">
                    <a href="{{ route('blog.index') }}" class="text-blue-500 inline-block">Back to Blogs</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
