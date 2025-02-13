<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- Search and Category Filters -->
                <div class="mb-4 flex justify-between">
                    <input type="text" id="search" placeholder="Search..." class="p-2 border rounded w-full" value="{{ request('search') }}">

                    <select id="category" class="ml-4 p-2 border rounded" name="category">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <form action="{{ url()->current() }}" method="GET">
                        <button type="submit" class="ml-4 px-4 py-2 bg-gray-300 rounded">Reset</button>
                    </form>
                </div>

                <!-- Displaying Posts -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($Posts as $post) <!-- Change $Posts to $posts -->
                        <div class="border p-4 rounded shadow">
                            @if(!empty($post->image))
                                <img src="{{ asset('images/'.$post->image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover">
                            @else
                                <img src="{{ asset('storage/images/default.jpg') }}" alt="{{ $post->title }}" class="w-full h-40 object-cover">
                            @endif
                            <h2 class="text-xl font-bold mt-2">{{ $post->title }}</h2>

                            @php
                                $category = $categories->firstWhere('id', $post->category_id);
                            @endphp

                            @if($category)
                                <p class="text-sm text-gray-600">Category: {{ $category->name }}</p>
                            @endif
                            
                            <a href="{{ route('blog.show', $post->id) }}" class="text-blue-500 mt-2 inline-block">Read More</a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $Posts->links() }} <!-- Use $posts here instead of $Posts -->
                </div>
            </div>
        </div>
    </div>
   

</x-app-layout>
