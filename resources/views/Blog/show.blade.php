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
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <div class="flex items-center gap-3">
                            @if($comment->user->profile_photo_path)
                            <img src="{{asset('storage/'.$comment->user->profile_photo_path)}}" 
                                alt="user" class="w-10 h-10 rounded-full object-cover">
                            @else
                            <img src="{{asset('storage/images/default.jpg')}}" 
                                alt="user" class="w-10 h-10 rounded-full object-cover">
                            @endif
                            

                            <p class="text-gray-900 font-semibold">
                                {{$comment->user->name }} 
                                <span class="text-gray-600 text-sm">({{ $comment->created_at->diffForHumans() }})</span>
                            </p>
                        </div>

                        <p class="text-gray-800 mt-2">{{ $comment->content }}</p>

                        <div class="mt-4">
                            <button class="text-blue-500 text-sm" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>                           
                            <div id="reply-form-{{ $comment->id }}" class="mt-2 hidden">
                            <form action="{{ route('comments.storeReply', $comment->id) }}" method="POST">
                                @csrf
                                <textarea name="reply" class="w-full p-2 border rounded" placeholder="Write your reply..." rows="3"></textarea>
                                @error('reply')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="mb-2">
                                <button type="submit" class="mt-2 bg-blue-500 text-white p-2 rounded">Submit Reply</button>
                                </div>
                            </form>
                         </div>
                        </div>
                        @foreach($comment->reply as $reply1)
                            <div class="ml-6 mt-2 bg-gray-200 p-4 rounded-lg shadow">
                                <div class="flex items-center gap-3">
                                    @if($reply1->user->profile_photo_path)
                                        <img src="{{asset('storage/'.$reply1->user->profile_photo_path)}}" 
                                            alt="user" class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <img src="{{asset('storage/images/default.jpg')}}" 
                                            alt="user" class="w-8 h-8 rounded-full object-cover">
                                    @endif

                                    <p class="text-gray-900 font-semibold">
                                        {{$reply1->user->name }} 
                                        <span class="text-gray-600 text-sm">({{ $reply1->created_at->diffForHumans() }})</span>
                                    </p>
                                </div>

                                <p class="text-gray-800 mt-2">{{ $reply1->reply }}</p>
                            </div>
                        @endforeach
                    </div>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" id="formdata" action="{{route('comment.store',$data['id'])}}" class="mt-6">
                        @csrf
                       @auth
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

<!--login page pop up-->
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
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById('reply-form-' + commentId);
        replyForm.classList.toggle('hidden');
    }
</script>
</x-app-layout>
