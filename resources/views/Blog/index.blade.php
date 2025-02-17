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
                <form method="GET" action="{{ url()->current() }}" >

                    <div class="mb-4 flex justify-between">
                        <input type="text" name="search" placeholder="Search..." class="p-2 border rounded  md:w-3/4 " value="{{ request('search') }}">

                        <select name="category" class="ml-4 p-2 border rounded">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="ml-4 px-4 bg-blue-500 text-white rounded">Filter</button>
                        <a href="{{ url()->current() }}" class="ml-4 px-4 py-2 bg-gray-300 rounded">Reset</a>

                    </div>
                </form>


                <!-- Displaying Posts -->
                @if($Posts->count()>0)

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
                                <p class="text-sm text-gray-600">Category: {{ $category->name ?? 'Uncategorized' }}</p>
                            @endif
                            
                            <a href="{{ route('blog.show', $post->id) }}" class="text-blue-500 mt-2 inline-block">Read More</a>
                        </div>
                    @endforeach
                    </div>

                @else
                
                <div class="flex items-center justify-center h-64 border p-4 rounded shadow">
                    <p class="text-center text-gray-500 text-lg">No blogs found.</p>
                </div>

                @endif

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $Posts->links() }} <!-- Use $posts here instead of $Posts -->
                </div>
            </div>
        </div>
    </div>
   

</x-app-layout>
