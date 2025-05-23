<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">New Post</h2>
            <a href="{{ route('post.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back</a>
        </div>

            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-md font-bold mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{old('title')}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                        @error('title')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-md font-bold mb-2">Content</label>
                        <textarea name="content" id="editor" value="{{old('content')}}" class=" shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </textarea>
                        @error('content')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror
                    </div>

              
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="block text-gray-700 text-md font-bold mb-2">Author</label>

                                <select name="author_name" class="form-control w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" >
                                    <option value="{{ $data['id'] }}"  selected>{{ $data['name'] }}</option>
                                </select>

                                @error('author_name')
                                <span class="text-red-500 text-sm">{{$message}}</span>
                                @enderror

                                

                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="" class="block text-gray-700 text-md font-bold mb-2">Category</label>
                                <select name="category_name" class="form-control w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" >
                                <option class="text-center" value=""selected disabled>--seletct Category --</option>

                                    @foreach($categories as $category)
                                    <option class="text-center" value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_name')
                                <span class="text-red-500 text-sm">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                    </div>
                               
                            <div class="row">
                               <div class="col-md-6">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block ">Attach Image</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                    type="file"
                                    id="upload"
                                    name="image"
                                    hidden
                                    accept="image/png, image/jpeg"
                                    />
                                </label>
                                @error('image')
                                <span class="text-red-500 text-sm">{{$message}}</span>
                                @enderror

                                </div>
                                <div class="col-md-6">
                                <img
                                src="{{ asset('storage/images/default.jpg') }}"
                                alt="user-avatar"
                                class="d-block rounded mb-4"
                                height="100"  
                                width="100"
                                id="uploadedAvatar"
                                />
                                </div>
                              
                            </div>
                <button type="submit" name="publish_status" value="0" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 ">Save or Draft</button>
                <button type="submit" name="publish_status" value="1" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 ">Publish</button>
            </form>
        </div>
    </div>
</div>
<style>

.ck-editor__editable_inline {

    min-height: 300px;

}

</style>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

<script>
    document.getElementById('upload').addEventListener('change', function (event) {
     //   alert('ab');
        const [file] = event.target.files; // Get the selected file
        if (file) {
            const uploadedAvatar = document.getElementById('uploadedAvatar'); // Get the img element
            uploadedAvatar.src = URL.createObjectURL(file); // Update image src with selected file
        }
    });
</script> 
<script>

    ClassicEditor

        .create( document.querySelector( '#editor' ),{

            ckfinder: {

                uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',

            }

        })

        .catch( error => {

              

        } );

</script>

</x-app-layout>
