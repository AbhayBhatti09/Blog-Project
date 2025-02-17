<x-app-layout>
    <x-slot name="header">
                <div class="flex">
                    <!--post -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('soft.index') }}" :active="request()->routeIs('soft.index')">
                            {{ __('Restore Post') }}
                        </x-nav-link>
                    </div>
                      <!--comment -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('soft.comment.index') }}" :active="request()->routeIs('soft.comment.index')">
                            {{ __('Restore Comment') }}
                        </x-nav-link>
                    </div>
                </div>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 font-medium text-md text-green-400">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="text-right">
            <a href="{{route('post.restore.all')}}" class="bg-blue-500 text-white px-4 py-2 rounded ">restore All</a>
            </div>

            <table class="min-w-full mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Title</th>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Content</th>
                        <th class="border border-gray-300 px-4 py-2">Created at</th>
                        <th class="border border-gray-300 px-4 py-2">Restore</th>
                        


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
                            <th class="border border-gray-300 px-4 py-2">{!!$post->content !!}</th>
                            <th class="border border-gray-300 px-4 py-2">{{$post->updated_at->format('Y-m-d h:m A')}}</th>
                            <th class="border border-gray-300 px-4 py-2">
                           
                        <a href="{{route('post.restore',$post->id)}}" 
                        class="btn-outline-danger px-3 py-1 rounded hover:bg-blue-600"  title="restore" data-bs>
                        <i class="fas fa-trash-restore"></i>
                        </a>

                        </th>
                           
                        </tr>
                </tbody>
                @endforeach

            </table>
            <div>
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
                <h5 class="modal-title" id="deleteModalLabel">Restore Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Restore this Post?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-primary" id="confirmDelete">Restore</a>
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
