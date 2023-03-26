<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all(); //select * from posts

        return PostResource::collection($allPosts);

//        $response = [];
//
//        foreach ($allPosts as $post) {
//            $response [] = [
//                'id' => $post->id,
//                'title' => $post->title,
//                'description' => $post->description,
//            ];
//        }
//
//        return $response;
    }

    public function show($id)
    {
        $post = Post::find($id);

        return new PostResource($post);

//        return [
//            'id' => $post->id,
//            'title' => $post->title,
//            'description' => $post->description,
//        ];
    }

    public function store(StorePostRequest $request)
    {
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return new PostResource($post);

//        return [
//            'id' => $post->id,
//            'title' => $post->title,
//            'description' => $post->description,
//        ];
    }
}