<div class="bg-white-50 p-3 rounded-lg shadow mt-2" id="comment-{{ $reply->id }}">
    <div class="flex items-center gap-3">
        @if($reply->user->profile_photo_path)
            <img src="{{ asset('storage/'.$reply->user->profile_photo_path) }}" 
                 alt="user" class="w-8 h-8 rounded-full object-cover">
        @else
            <img src="{{ asset('storage/images/default.jpg') }}" 
                 alt="user" class="w-8 h-8 rounded-full object-cover">
        @endif

        <p class="text-gray-900 font-semibold">
            {{ $reply->user->name }} 
            <span class="text-gray-600 text-sm">({{ $reply->created_at->diffForHumans() }})</span>
        </p>
    </div>
    <?php
    $comment=App\Models\Neasted_Comment::where('id',$reply->parent_id)->first();
    $user=App\Models\User::where('id',$comment->user_id)->first();
     // echo $user->name; 
      ?>
     @if($user)
     
     <p class="text-gray-800 mt-1"><strong><?php echo $user->name; ?></strong> {{ $reply->body }}</p>
     @endif   
        
    
   
   

    <div class="mt-2">
        <button class="flex items-center text-blue-500 text-sm" onclick="showReplyForm({{ $reply->id }}, '{{ $reply->post_id }}')">
            Reply
        </button>
    </div>

    @if($reply->replies)
        <div class="ml-10 mt-3 border-l-2 border-gray-300 pl-4">
            @foreach ($reply->replies as $nestedReply)
                @include('Blog.partials.reply', ['reply' => $nestedReply])
            @endforeach
        </div>
    @endif
</div>
