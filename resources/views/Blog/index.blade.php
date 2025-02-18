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
                        <input type="text" id="search" name="search" placeholder="Search..." class="p-2 border rounded  md:w-3/4 " value="{{ request('search') }}">

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
                <div id="post-list">
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
