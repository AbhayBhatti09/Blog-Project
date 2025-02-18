<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ $data['Category'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                
            <div class="bg-white p-6 rounded-lg shadow">
            @if(session('success'))
                    <div class="mb-4 font-medium text-md text-green-400">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="mt-6 mb-4">
                    <a href="{{ route('blog.index') }}" class="text-blue-500 inline-block"><i class="fa fa-arrow-left">Back</i></a>
                </div>
                
                <div class="flex justify-between items-center">
                    @if(!empty($data['image']))
                        <img src="{{ asset('images/'.$data['image']) }}" alt="{{ $data['title'] }}" class="w-50 sm:w-1/2 md:w-3/4 lg:w-full h-50 object-cover rounded">
                    @else
                        <img src="{{ asset('storage/images/default.jpg') }}" alt="{{ $data['title'] }}" class="w-50 sm:w-1/2 md:w-3/4 lg:w-full h-50 object-cover rounded">
                    @endif
                </div>

                <h1 class="text-3xl font-bold mt-6">{{ $data['title'] }}</h1>
              


                <div class="mt-4 text-gray-800">
                {!!($data['content']) !!}
                </div>
                <p class="text-lg text-gray-600 mt-2">Publish on: {{ $data['author_name'] }} , {{$data['created_at']->diffForHumans()}} </p>
                 <div class="mt-8">
                    <h2 class="text-2xl font-bold mb-4">Comments</h2>

                    <div class="space-y-4">
                    @if($comments)
    @foreach($comments as $comment)
        <div class="bg-gray-100 p-4 rounded-lg shadow mb-4" id="comment-{{ $comment->id }}">
            <div class="flex items-center gap-3">
                @if($comment->user->profile_photo_path)
                    <img src="{{ asset('storage/'.$comment->user->profile_photo_path) }}" 
                         alt="user" class="w-10 h-10 rounded-full object-cover">
                @else
                    <img src="{{ asset('storage/images/default.jpg') }}" 
                         alt="user" class="w-10 h-10 rounded-full object-cover">
                @endif
                
                <p class="text-gray-900 font-semibold">
                    {{ $comment->user->name }} 
                    <span class="text-gray-600 text-sm">({{ $comment->created_at->diffForHumans() }})</span>
                </p>
            </div>

            <p class="text-gray-800 mt-2">{{ $comment->body }}</p>

            <div class="mt-4">
                <button class="flex items-center text-blue-500 text-sm" onclick="showReplyForm({{ $comment->id }}, '{{ $comment->post_id }}')">
                   
                    Reply
                </button>
            </div>

            @if($comment->replies)
                <div class="ml-10 mt-3 border-l-2 border-gray-300 pl-4">
                    @foreach ($comment->replies as $reply)
                        @include('Blog.partials.reply', ['reply' => $reply])
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
@endif
                    <form method="POST" id="formdata" action="{{route('neasted.store')}}" class="mt-6">

                        @csrf
                       @auth
                       <input type="hidden" name="post_id" value="{{ $data['id'] }}">
                        <input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                       @endauth
                        <div class="mb-4">
                            <label for="content" class="block text-gray-700">Your Comment</label>
                            <textarea id="content" name="comment" class="w-full p-2 border rounded-lg" rows="4" required></textarea>
                            @error('comment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-outline-primary px-6 py-2   rounded-lg">Submit Comment</button>
                    </form>
                </div>
                

                
            </div>
        </div>
    </div>
    <div id="global-reply-form" class="hidden bg-white p-4 rounded-lg shadow mt-4">
    <form action="{{ route('neasted.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" id="global-post-id" value="">
        <input type="hidden" name="parent_id" id="global-parent-id" value="">
        <input type="hidden" name="comment_type" value="comment">
        
        <textarea name="comment" class="w-full p-2 border rounded" placeholder="Write your reply..." rows="3"></textarea>
        @error('comment')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
        <div class="mt-2">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Submit Reply</button>
            <!-- Optional cancel button to hide the reply form -->
            <button type="button" class="ml-2 p-2 border rounded" onclick="hideReplyForm()">Cancel</button>
        </div>
    </form>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p>You must be logged or registered in to post a comment.</p>
            <a href="{{route('login')}}" class="text-blue-600 font-bold underline hover:text-blue-800">Login </a>
            or
            <a href="{{route('register')}}" class="text-blue-600 font-bold underline hover:text-blue-800"> Register</a>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary"id="" data-bs-dismiss="modal">Cancel</button>
            </div> -->
        </div>
    </div>
</div>
<script>
                document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.querySelectorAll('.btn-outline-primary');
    const commentForm = document.getElementById('formdata');

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevents the link's default behavior
            const deleteUrl = this.getAttribute('href');
            const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

            
            if (isAuthenticated) {
                commentForm.submit();
                // If authenticated, redirect to the delete URL
               // window.location.href = deleteUrl;
              // const form = document.querySelector('form');
             //  form.action = deleteUrl;
             //  form.submit();
              // alert('ab');
            } else {
               // alert('ab1');
                // If not authenticated, show the login modal
                var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                myModal.show();
            }
        });
    });
});

  </script>


<script>
    // Function to move the global reply form to the desired comment container
    function showReplyForm(commentId, postId) {
        // Get the global reply form element
        var replyForm = document.getElementById('global-reply-form');
        
        // Update the hidden input fields with the current post and parent comment IDs
        document.getElementById('global-post-id').value = postId;
        document.getElementById('global-parent-id').value = commentId;
        
        // Remove the reply form from its current parent (if any)
        if(replyForm.parentNode) {
            replyForm.parentNode.removeChild(replyForm);
        }
        
        // Append the reply form to the current comment container so that it appears right below it
        var commentContainer = document.getElementById('comment-' + commentId);
        commentContainer.appendChild(replyForm);
        
        // Make sure the reply form is visible
        replyForm.classList.remove('hidden');
    }

    // Optional: Function to hide the reply form if the user cancels
    function hideReplyForm() {
        var replyForm = document.getElementById('global-reply-form');
        replyForm.classList.add('hidden');
    }
</script></x-app-layout>
