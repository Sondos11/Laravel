@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>

            @if($post->image !=null)
            <img src="{{'/'.'storage/'.$post->image}}" width="250" alt=""/>
            @endif
        </div>
    </div>

    <div class="card mt-6">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>


    <form method="post" action="{{route('comments.store',$post->id)}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" cols="6" rows="3"></textarea>
            <button class="btn btn-success">Comment</button>
        </div>
    </form>

    <div>
        @foreach($comments as $comment)
        <div class="card mt-6">
            <div class="card-body">
                <p class="card-text">{{$comment->comment}}</p>
                <span class="card-text">{{$comment->created_at}}</span>
                <form class="ms-5" style="display:inline" method="post" action="{{route('comments.destroy',$comment->id)}}"
                onclick="return confirm('Are you sure you want to delete this comment?')">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger">Delete</button>
            </form>

            </div>

        </div><br>
        @endforeach
    </div>



@endsection