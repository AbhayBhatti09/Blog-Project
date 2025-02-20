@if($Posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($Posts as $post)
           
            <div class="border p-4 rounded shadow">
                <a href="{{ route('blog.show', $post->id) }}" class="block transform transition duration-300 hover:scale-105">
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
                
                <a href="{{ route('blog.show', $post->id) }}" class="text-blue-500 mt-2 inline-block relative group">Read More     <span class="absolute left-0 bottom-0 w-0 h-0.5 bg-blue-500 transition-all duration-1000 group-hover:w-full"></span>
                </a>
                </a>
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
    {{ $Posts->links() }}
</div>
