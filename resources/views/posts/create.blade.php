@extends('layouts.app')

@section('content')
   <div class="card card-default">
       <div class="card-header">
           {{isset($post) ? 'Edit Post' :    ' Add new post' }}
       </div>

       @if ($errors->any())
           <div class="alert alert-danger">
               <ul>
                   @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
               </ul>
           </div>
       @endif

       <div class="card-body">
           <form action="{{isset($post) ? route('posts.update', $post->id): route('posts.store')}}"
                 method="POST"  enctype="multipart/form-data">
               @csrf
               @if(isset($post))
                   @method('PUT')
               @endif

               <div class="form-group form-floating">
                   <label for="title">title : </label>
                   <input type="text" name="title"  class="form-control"
                          placeholder = "Add a new post"
                          value="{{isset($post) ? $post->name : "" }}">
               </div>
               <div class="form-floating form-group">
                   <label for="description">description :</label>
                   <textarea class="form-control" placeholder="Enter description"  name="description" rows="2"></textarea>
               </div>
               <div class="form-floating form-group">
                   <label for="content">content :</label>
                   <input id="x" type="hidden" name="content">
                   <trix-editor input="x"></trix-editor>
               </div>
               <div class="form-floating form-group">
                   <label for="content">Image :</label>
                   <input type="file" name="image" class="form-control">
               </div>

               <div class="form-group">
                   <button  class="btn btn-success">{{isset($post) ? 'Update' : 'Add'}}</button>
               </div>
           </form>
       </div>
   </div>
@endsection
@section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
