@extends('layouts.app')


@section('content')
    <div class="clearfix">
        <a href="{{route('posts.create')}}" class="btn btn-success " style=" margin-bottom: 10px; float: right " >Add Posts</a>
    </div>
      <div class="card card-default">
          <div class="card-header">All Posts</div>
          <div class="card-body">
              @if($posts->count() > 0 )
                  <table class="table">
                      <thead>
                      <tr>
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
                              <td>{{$post->title}}</td>
                              <td>{{$post->description}}</td>
                              <td>{{$post->content}}</td>
                              <td>
                                  <img src="{{asset('storage/'.$post->image)}}"
                                       width="100px" height="100px">
                              </td>
                              <td>
                                  @if(!$post->trashed())
                                      <a href="{{route('posts.edit', $post->id)}}" type="button" class="btn btn-primary">Edit</a>
                                      <a href="{{route('posts.edit', $post->id)}}" type="button" class="btn btn-primary">Restore</a>
                                  @endif
                                  <form CLASS="float-right" action="{{route('posts.destroy', $post->id)}}" method="POST">
                                      @CSRF
                                      @method('DELETE')
                                      <button class="btn btn-danger">{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                                  </form>
                              </td>

                          </tr>
                          </tbody>
                      @endforeach
                  </table>
              @else
                  <div class="card-body">
                      <h1 class="text-center">
                          No Posts Yet !
                      </h1>
                  </div>
              @endif
          </div>
      </div>
    @endsection
