@extends('layouts.app')


@section('content')
    <div class="clearfix">
        <a href="{{route('posts.create')}}" class="btn btn-success " style=" margin-bottom: 10px; float: right " >Add Posts</a>
    </div>
      <div class="card card-default">
          <div class="card-header">All Posts</div>
          <div class="card-body">
              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">description</th>
                      <th scope="col">content</th>
                      <th scope="col">image</th>
                      <th scope="col">Actions</th>
                  </tr>
                  </thead>
                  @foreach($posts as $post)
                  <tbody>
                  <tr>
                      <th scope="row">{{$post->id}}</th>
                      <td>{{$post->title}}</td>
                      <td>{{$post->description}}</td>
                      <td>{{$post->content}}</td>
                      <td><img src="{{asset('storage/'.$post->image)}}"
                          width="100px" height="100px"></td>
                      <td>
                          <a href="{{route('posts.edit', $post->id)}}" type="button" class="btn btn-primary">Edit</a>
                          <form CLASS="float-right" action="{{route('posts.destroy', $post->id)}}" method="POST">
                              @CSRF
                              @method('DELETE')
                              <button class="btn btn-danger">Delete</button>
                          </form>
                      </td>

                  </tr>
                  </tbody>
                  @endforeach
              </table>
          </div>
      </div>
    @endsection
