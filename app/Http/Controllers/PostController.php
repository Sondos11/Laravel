<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostName;
use Illuminate\Support\Facades\Storage;


use function PHPSTORM_META\type;

class PostController extends Controller
{
    public function index()
    {
        // $allPosts = Post::all();
        $allPosts  = Post::with('user')->paginate(3);

        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
//        dd($id);
        $post = Post::find($id);

//        dd($post);
          $comments=$post->comments;

        return view('post.show',["comments"=>$comments] ,['post' => $post]);
    }

    public function create(){

        $users=User::all();
        return view('post.create',['users'=>$users]);
    }

    public function store(StorePostRequest $request){
        // type 1
        // $data=request()->all();
        // dd($data);
        
        // type 2
         $title=request()->title;
         $description=request()->description;
         $post_creator=request()->post_creator;
        // dd($title , $description , $post_creator);

        // type 3
       // $data=$request->all();
        // dd($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $path = Storage::disk("public")->putFileAs('posts', $image, $filename);

             Post::create([

                'title' => $title,
                'description' => $description,
                'user_id' => $post_creator,
                'image'=>$path
    
            ]);

              }else{
    Post::create([

        'title' => $title,
        'description' => $description,
        'user_id' => $post_creator,

    ]);
}


        //insert the form data in database
        Post::create([
            'title' => $title ,
            'description' => $description ,
            'user_id' => $post_creator
        ]);

        // return redirect()->route('posts.index');
        return to_route('posts.index');
    }

     public function edit($postId)
    {
        $post = Post::find($postId);
        $users=User::all();
            return view('post.edit', [
                'post' => $post,
                'users' => $users,
            ]);
       
    }

     public function update(UpdatePostName $request, $postId){
        $users = User::all();
        $post = Post::find($postId);
        // $post->update([
        //     'title' => $request['title'],
        //     'description' => $request['description'],
        //      'user_id' => $request['post_creator'],
        // ]);

                $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->input('post_creator');
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk("public")->delete($post->image);
            }
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();
                $path = Storage::disk("public")->putFileAs('posts', $image, $filename);
                $post->image = $path;
                
        }

        $post->save();

        return redirect()->route("posts.index");

        // return view('post.show', [
        //     'post' => $post,
        //     'users' => $users,
        // ]);
     }

     public function delete($postId)
    {
        $post = Post::find($postId);
        post::where('id', $postId)->delete();
        return to_route('posts.index');
        
    }


}
