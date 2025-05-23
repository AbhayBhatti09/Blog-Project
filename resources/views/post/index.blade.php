<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 font-medium text-md text-green-400">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex justify-between items-center mb-4">
    <form method="GET" action="{{ route('post.index') }}">
        <label for="statusFilter" class="mr-2">Filter by Status:</label>
        <select name="status" id="statusFilter" class="border border-gray-300 px-3 py-2 rounded">
            <option value="">All</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Published</option>
            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Draft</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Filter</button>
    </form>

    <a href="{{route('post.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded">
        Add Post
    </a>
</div>

            <table class="min-w-full mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Author Name</th>
                        <th class="border border-gray-300 px-4 py-2">Post Status</th>
                        <th class="border border-gray-300 px-4 py-2">Created at</th>
                        
                        <th class="border border-gray-300 px-4 py-2">Action</th>


                    </tr>
                </thead>
                @foreach($Posts as $index =>  $post)

                <tbody>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">{{ $Posts->perPage() * ($Posts->currentPage() - 1) + $index + 1 }}</th>
                            <th class="border border-gray-300 px-4 py-2">{{$post->title}}</th>
                            @if($post->category && !is_null($post->category->name))
                                <th class="border border-gray-300 px-4 py-2">{{$post->category->name}}</th>
                            @else
                                <th class="border border-gray-300 px-4 py-2">--</th>
                            @endif
                            <th class="border border-gray-300 px-4 py-2">{{$post->user->name }}</th>
                            <th class="border border-gray-300 px-4 py-2">
                                @if ($post->publish_status == 1)
                                    <span class="text-green-600">Published</span>
                                @else
                                    <span class="text-red-600">Draft</span>
                                @endif
                            </th>

                            <th class="border border-gray-300 px-4 py-2">{{$post->updated_at->format('Y-m-d h:m A')}}</th>
                            <th class="border border-gray-300 px-4 py-2">
                        <a href="{{route('post.edit',$post->id)}}" 
                        class="  px-3 py-1 rounded hover:bg-blue-600" title="Edit">
                        <i class="fas fa-edit"></i>
                            
                        </a>    
                        <a href="{{route('post.delete',$post->id)}}" 
                        class="btn-outline-danger px-3 py-1 rounded hover:bg-red-600"  title="delete" data-bs>
                        <i class="fas fa-trash-alt"></i>
                        </a>

                        </th>
                           
                        </tr>
                </tbody>
                @endforeach

            </table>
            <div class="mt-4">
                    {{ $Posts->links() }} 
                </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Category?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
                document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.querySelectorAll('.btn-outline-danger');

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevents the link's default behavior
            const deleteUrl = this.getAttribute('href');
            
            // Set the URL of the confirmation button
            document.getElementById('confirmDelete').setAttribute('href', deleteUrl);
            
            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        });
    });
});

              </script>
</x-app-layout>
