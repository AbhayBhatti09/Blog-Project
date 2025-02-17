<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Replies') }}
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
                            <th class="border border-gray-300 px-4 py-2">Post Category</th>
                            <th class="border border-gray-300 px-4 py-2">User Comment</th>
                            <th class="border border-gray-300 px-4 py-2">Commenter Name</th>
                            <th class="border border-gray-300 px-4 py-2">Reply Comment</th>
                            <th class="border border-gray-300 px-4 py-2"> Replier Name</th>
                            <th class="border border-gray-300 px-4 py-2">Created At</th>
                            <th class="border border-gray-300 px-4 py-2">Reply status</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    @foreach($Replies as $index => $reply)
                        <tbody>

                        <th class="border border-gray-300 px-4 py-2">{{ $Replies->perPage() * ($Replies->currentPage() - 1) + $index + 1 }}</th>
                        @php
                                $post = $posts->firstWhere('id', $reply->post_id);
                               
                        @endphp
                        @if($post)
                        <th class="border border-gray-300 px-4 py-2">{{$post->title}}</th>
                        @endif
                        @php
                                $comment = $comments->firstWhere('id', $reply->comment_id);
                        @endphp
                        @if($comment)
                        <th class="border border-gray-300 px-4 py-2">{{$comment->content}}</th>
                        @endif

                        @php
                                $user = $users->firstWhere('id', $reply->user_id);
                        @endphp
                        @if($user)
                        <th class="border border-gray-300 px-4 py-2">{{$user->name}}</th>
                        @endif

                       
                        <th class="border border-gray-300 px-4 py-2">{{$reply->reply}}</th>
                        @php
                                $user = $users->firstWhere('id', $reply->user_id);
                        @endphp
                        @if($user)
                        <th class="border border-gray-300 px-4 py-2">{{$user->name}}</th>
                        @endif
                        
                        <th class="border border-gray-300 px-4 py-2">{{$reply->updated_at->format('Y-m-d h:i A')}}</th>
                        <th class="border border-gray-300 px-4 py-2">
                            @if($reply->status==1)
                            Approved
                            @else
                            Disabled
                            @endif
                        </th>
                        <th class="border border-gray-300 px-4 py-2">
                            
                        </a>    
                        <a href="" 
                        class="r px-3 py-1 rounded hover:bg-blue-600"  data-bs-toggle="modal" data-bs-target="#deleteModal_{{$reply->id}}"  data-comment-id="{{ $reply->id }}" title="status" data-bs>
                        <i class="fas fa-edit"></i>
                        </a>

                       

                        </th>
                         <!-- Modal -->
                         <div class="modal fade" id="deleteModal_{{$reply->id}}" tabindex="-1" aria-labelledby="deleteModalLabel_{{$reply->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal_{{$reply->id}}"> Reply Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to this comment Reply Approve or disable in this blog?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('reply.status',$reply->id)}}" class="btn btn-success" id="confirmDelete">Approve</a>
                                        <a href="{{route('reply.disable',$reply->id)}}" class="btn btn-warning" id="confirmDelete">disable</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </tbody>

                        @endforeach
                       
                       
                </table>
                <div>
                </div>
            </div>
        </div>
    </div>
<!-- <script>
                document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.querySelectorAll('.btn-outline-danger');
    const urlbtn=document.querySelectorAll('.btn-success');

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

              </script> -->
</x-app-layout>

