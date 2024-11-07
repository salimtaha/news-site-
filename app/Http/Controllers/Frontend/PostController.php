<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewCommentNotify;

class PostController extends Controller
{
    public function show($slug)
    {
        $mainPost = Post::active()->with(['comments'=>function($query){
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();

        if(!$mainPost){
            abort(404);
        }
        $category = $mainPost->category;
        $posts_belongs_to_category = $category->posts()
            ->select('id', 'slug', 'title')
            ->limit(5)
            ->get();

        $mainPost->increment('num_of_views');
        return view('frontend.show', compact('mainPost', 'posts_belongs_to_category'));
    }

    public function getAllPosts($slug)
    {
        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }

    public function saveComment(Request $request)
    {
        $request->validate([
            'user_id'=>['required' , 'exists:users,id'],
            'comment'=>['required' , 'string' , 'max:200'],
        ]);

        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'comment'=>$request->comment,
            'post_id'=>$request->post_id,
            'ip_address'=>$request->ip(),
        ]);

        $post = Post::findOrFail($request->post_id);

        if(auth()->user()->id != $request->user_id){
            $post->user->notify(new NewCommentNotify($comment , $post));
        }

        $comment->load('user');
        if(!$comment){
           return response()->json([
             'data'=>'Operation failed',
             'status'=>403,
           ]);

        }

        return response()->json([
            'msg'=>'Comment Stored Successfuly!',
            'comment'=>$comment,
            'status'=>201,
        ]);
    }


}
