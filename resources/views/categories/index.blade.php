@extends('layouts.app')


@section('content')
    <div class="clearfix">
        <a href="{{route('categories.create')}}" class="btn btn-success " style=" margin-bottom: 10px; float: right " >Add categories</a>
    </div>
      <div class="card card-default">
          <div class="card-header">All categories</div>
          <div class="card-body">
              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Actions</th>
                  </tr>
                  </thead>
                  @foreach($categories as $category)
                  <tbody>
                  <tr>
                      <th scope="row">{{$category->id}}</th>
                      <td>{{$category->name}}</td>
                      <td>
                          <a href="{{route('categories.edit', $category->id)}}" type="button" class="btn btn-primary">Edit</a>
                          <form CLASS="float-right" action="{{route('categories.destroy', $category->id)}}" method="POST">
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
