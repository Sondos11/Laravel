@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <form action="{{ route('posts.update', ['post' => $post['id']]) }}" method="post">
        @method('PUT')
        @csrf

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5">{{ $post->description }}</textarea>
</div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Post Creator</label>
    <select class="form-control" name="post_creator">
      @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->name}}</option>
     @endforeach
   </select>
  </div>
 
  <button type="submit" class="btn btn-success">Update</button>
</form>

@endsection