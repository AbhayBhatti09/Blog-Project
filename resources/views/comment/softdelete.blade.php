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
            <a href="{{route('comment.restore.all')}}" class="bg-blue-500 text-white px-4 py-2 rounded ">restore All</a>
            </div>

               
                <table class="min-w-full mt-4 border-collapse border border-gray-300" id="">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Commenter Name</th>
                            <th class="border border-gray-300 px-4 py-2">Blog Post Title</th>
                            <th class="border border-gray-300 px-4 py-2">Comment</th>
                            <th class="border border-gray-300 px-4 py-2">Created At</th>
                            <th class="border border-gray-300 px-4 py-2">Comment status</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                        @foreach($comments as $index => $comment)
                        <tbody>

                        <th class="border border-gray-300 px-4 py-2">{{ $comments->perPage() * ($comments->currentPage() - 1) + $index + 1 }}</th>
                        @php
                                $user = $users->firstWhere('id', $comment->user_id);
                        @endphp
                        @if($user)
                        <th class="border border-gray-300 px-4 py-2">{{$user->name}}</th>
                        @endif

                        @php
                                $post = $posts->firstWhere('id', $comment->post_id);
                        @endphp
                        @if($post)
                        <th class="border border-gray-300 px-4 py-2">{{$post->title}}</th>
                        @endif

                        <th class="border border-gray-300 px-4 py-2">{{$comment->body}}</th>
                        <th class="border border-gray-300 px-4 py-2">{{$comment->updated_at->format('Y-m-d h:i A')}}</th>
                        <th class="border border-gray-300 px-4 py-2">
                            @if($comment->status==1)
                            Approved
                            @else
                            Disabled
                            @endif
                        </th>
                        <th class="border border-gray-300 px-4 py-2">
                            
                        <a href="{{route('comment.restore',$comment->id)}}" 
                        class="btn-outline-danger px-3 py-1 rounded hover:bg-blue-600"  id="confirmDelete" title="restore" data-bs>
                        <i class="fas fa-trash-restore"></i>
                        </a>  
                       
                       
                       

                        </th>
                        
                        </tbody>

                        @endforeach
                       
                </table>
                <div class="mt-4">
                    {{ $comments->links() }} 
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
       // alert('ab');
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

  

</x-app-layout>

