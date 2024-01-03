<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
       
    </x-slot>
    <div class="create-post" data-bs-toggle="modal" data-bs-target="#exampleModal">
 
 <a href="#"class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
     <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">New Post</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action={{ route("post.create") }} method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="recipient-name" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Date:</label>
                    <input type="text" class="form-control" id="recipient-name" placeholder="May 21,2023" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="message-text" rows="5" name="description" required></textarea>
                </div>
                
                <div class="mb-3">
                <label for="formFileLg" class="form-label">Choose an image:</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="background-color: green">Submit</button>
                </div>
            </form>
        </div>
     </div>
 </div>
</div>
@foreach($posts as $post)
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 left-badge" style="display:flex;justify-content:space-around; align-items: center">
                    <div>
                        <img src={{$post->img_url}} alt={{$post->title}} width="50" height="50">
                    </div>
                   <div>
                        <h2 style="font-size: 17px; margin-left: 10px"> {{$post->title}}</h2>
                   </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 right-badge">
                    <a href={{route("post.edit",$post->id)}} class="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <a href={{route("post.delete",$post->id)}} class="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
</x-app-layout>
