<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
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
                <div class="text-right mb-4 ">
                    <a href="{{route('category.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</a>
                </div>

                <table class="min-w-full mt-4 border-collapse border border-gray-300" id="">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Created At</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                        @foreach($Categories as $index => $category)
                        <tbody>

                        <th class="border border-gray-300 px-4 py-2">{{ $Categories->perPage() * ($Categories->currentPage() - 1) + $index + 1 }}</th>
                        <th class="border border-gray-300 px-4 py-2">{{$category->name}}</th>
                        <th class="border border-gray-300 px-4 py-2">{{$category->updated_at->format('Y-m-d h:i A')}}</th>
                        <th class="border border-gray-300 px-4 py-2">
                        <a href="{{route('category.edit',$category->id)}}" 
                        class="  px-3 py-1 rounded hover:bg-blue-600" title="Edit">
                        <i class="fas fa-edit"></i>
                            
                        </a>    
                        <a href="{{route('category.delete',$category->id)}}" 
                        class="btn-outline-danger px-3 py-1 rounded hover:bg-red-600"  title="delete" data-bs>
                        <i class="fas fa-trash-alt"></i>
                        </a>

                        </th>
                        </tbody>

                        @endforeach
                       
                </table>
                <div class="mt-4">
                    {{ $Categories->links() }} 
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

