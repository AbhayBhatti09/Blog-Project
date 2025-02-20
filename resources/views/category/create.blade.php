<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Add Category</h2>
            <a href="{{ route('category.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back</a>
        </div>

                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2"> Name:</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                        @error('name')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2"> Description:</label>
                        <textarea name="descrpition" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" ></textarea>
                        @error('descrpition')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row">
                               <div class="col-md-6">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block ">Attach logo</span>
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
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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

</x-app-layout>
