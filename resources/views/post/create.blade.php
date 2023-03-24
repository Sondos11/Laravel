@extends('layouts.app')

@section('title') Show @endsection

@section('content')

@if ($errors->any())
        <div class="alert alert-danger">
           <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
    @endif

    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"></textarea>
</div>
<div class="form-group">
             <label for="user" class="form-label">Image</label>
             <input class="form-control" name="image" type="file" id="formFile">
        </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Post Creator</label>
    <select class="form-control" name="post_creator">
      @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->name}}</option>
     @endforeach
   </select>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
