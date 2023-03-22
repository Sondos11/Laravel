<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PostController extends Controller
{
    public function index()
    {
        // $allPosts = Post::all();
        $allPosts  = Post::paginate(3);

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

    public function store(Request $request){
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

     public function update(Request $request, $postId){
        $users = User::all();
        $post = Post::find($postId);
        $post->update([
            'title' => $request['title'],
            'description' => $request['description'],
             'user_id' => $request['post_creator'],
        ]);

        return view('post.show', [
            'post' => $post,
            'users' => $users,
        ]);
     }

     public function delete($postId)
    {
        $post = Post::find($postId);
        post::where('id', $postId)->delete();
        return to_route('posts.index');
        
    }


}
