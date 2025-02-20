<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- Search and Category Filters -->
                <form method="GET" action="{{ url()->current() }}" >

                    <div class="mb-4 flex justify-between">
                        <input type="text" id="search" name="search" placeholder="Search..." class="p-2 border rounded  md:w-3/4 " value="{{ request('search') }}">

                        <select name="category" class="ml-4 p-2 border rounded">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="ml-4 px-4 bg-blue-500 text-white rounded">Filter</button>
                        <a href="{{ url()->current() }}" class="ml-4 px-4 py-2 bg-gray-300 rounded">Reset</a>

                    </div>
                </form>
                <div class="p-4 text-center border rounded-lg shadow-lg bg-gray">

                @if(isset($selectedCategory))
                <h4 class=" font-semibold text-gray-800 mb-1">Blog Category</h4>
                    <h1 class="text-3xl font-semibold text-gray-800 mb-6 "><span class="inline-block border-b-4 border-blue-500 pb-1">{{ $selectedCategory->name }} </span></h1>
                    <p>{{ $selectedCategory->descrpition }}</p>
                @else
                    <h1 class="text-3xl font-semibold text-gray-800 mb-6"><span class="inline-block border-b-4 border-blue-500 pb-1">Blogs </span></h1>
                @endif
                </div>
<div class="p-6 text-center border-2 border-gray-300 rounded-lg shadow-lg bg-white mt-2">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <a href="{{ url()->current() . '?category=' . \Illuminate\Support\Str::slug($category->name) }}" 
               class="block transform transition duration-300 hover:scale-105">
                <div class="p-2 text-lg font-medium text-gray-700 border rounded-lg h-auto shadow-md bg-gray-50 hover:bg-gray-100 flex items-center space-x-3">
                    <img src="{{ asset('images/logo/' . $category->image) }}" alt="{{ $category->name }}" 
                         class="w-16 h-16 object-cover rounded-full">
                    <div>
                        <strong class="block text-lg text-gray-900">{{ $category->name }}</strong>
                        <p class="text-gray-600">{{ $category->descrpition }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>


                <!-- Displaying Posts -->
                <div id="post-list" class="mt-8">
                    @include('Blog.partials.post-list')
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('blog.index') }}",
                        type: "GET",
                        data: { search: query },
                        success: function (data) {
                           
                            $('#post-list').html(data);
                        }
                    });
                } else {
                    $('#post-list').html('');
                }
            });
        });
    </script>

</x-app-layout>
