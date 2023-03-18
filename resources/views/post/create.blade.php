@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <form action="{{route('posts.store')}}" method="post">
        @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Creator</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Description</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="height: 200px">
  </div>
  
  <button type="submit" class="btn btn-primary">Post</button>
</form>

@endsection