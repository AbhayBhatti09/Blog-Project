<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comment') }}
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
                            
                        </a>    
                        <a href="" 
                        class="r px-3 py-1 rounded hover:bg-blue-600"  data-bs-toggle="modal" data-bs-target="#deleteModal_{{$comment->id}}"  data-comment-id="{{ $comment->id }}" title="status" data-bs>
                        <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{route('comment.delete',$comment->id)}}" 
                        class="show_confirm px-3 py-1 rounded hover:bg-red-600" id="softdelete" title="delete" data-bs>
                        <i class="fas fa-trash"></i>
                        </a>
                       
                       

                        </th>
                         <!--edit Modal -->
                         <div class="modal fade" id="deleteModal_{{$comment->id}}" tabindex="-1" aria-labelledby="deleteModalLabel_{{$comment->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal_{{$comment->id}}"> Comment Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to this comment Approve or disable in this blog?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('comment.status',$comment->id)}}" class="btn btn-success" id="confirmDelete">Approve</a>
                                        <a href="{{route('comment.disable',$comment->id)}}" class="btn btn-warning" id="confirmDelete">disable</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        </tbody>

                        @endforeach
                       
                </table>
                <div class="mt-4">
                    {{ $comments->links() }} 
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

 

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">

$('.show_confirm').click(function(event) {
    event.preventDefault();  // Prevent default link action

    var url = $(this).attr('href');  // Get the URL to redirect to after confirmation
    var name = $(this).data("name");

    swal({
        title: `Are you sure you want to delete this Comment?`,
        text: "This action will soft delete the Comment.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = url;  // Redirect to the delete route after confirmation
        }
    });
});


</script>

  

</x-app-layout>

