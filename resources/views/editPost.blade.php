<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {!! ($flag) ? '<div class="alert alert-success" role="alert">Updated Succesfully<div>' : __('Edit Post') !!}
        </h2>
    </x-slot>
    <div class="card" style="width: 90%;margin: 5px auto">
        <div class="card-body">
             <form action={{route('post.update',$post->id)}} method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="recipient-name" name="title" value="{{$post->title}}">
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Date:</label>
                    <input type="text" class="form-control" id="recipient-name" placeholder="May 21,2023" name="date" value="{{$post->date}}">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="message-text" rows="5" name="description">{{$post->description}}</textarea>
                </div>
                
                <div class="mb-3">
                <label for="formFileLg" class="form-label">Current image<img src={{$post->img_url}} width="50" height="50"/></label>
                <br>
                <label for="formFileLg" class="form-label">Update new image:</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="image">
                </div>
                <div class="submit">
                    <button type="submit" class="btn btn-primary" style="background-color: gray">Submit</button>
                </div>
            </form>
        </div>
    </div>
   
</x-app-layout>
