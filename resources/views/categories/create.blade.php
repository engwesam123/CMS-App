@extends('layouts.app')

@section('content')
   <div class="card card-default">
       <div class="card-header"> {{isset($category) ? 'Edit Category' :    ' Add new Category' }}
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
           <form action="{{isset($category) ? route('categories.update', $category->id): route('categories.store')}}" method="POST">
               @csrf
               @if(isset($category))
                   @method('PUT')
               @endif
               <div class="form-group" >
                   <label for="category">Category Name: </label>
                   <input type="text" name="name"  class="form-control"  placeholder = "Add a new category"
                   value="{{isset($category) ? $category->name : "" }}">
               </div>
               <div class="form-group">
                   <button  class="btn btn-success">{{isset($category) ? 'Update' : 'Add'}}</button>
               </div>
           </form>
       </div>
   </div>
@endsection
