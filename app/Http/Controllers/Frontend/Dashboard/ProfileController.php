<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->active()->with(['images'])->latest()->get();
        return view('frontend.dashboard.profile', compact('posts'));
    }
    public function storePost(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $this->commentAble($request);
            $post = auth()->user()->posts()->create($request->except(['_token', 'images']));

            ImageManger::uploadImages($request, $post);

            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['erorrs', $e->getMessage()]);
        }

        Session::flash('success', 'Post Created Successfuly!');
        return redirect()->back();
    }

    public function editPost($slug)
    {
        return $slug;
    }

    public function deletePost(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        if (!$post) {
            abort(404);
        }
        ImageManger::deleteImages($post);
        $post->delete();

        return redirect()->back()->with('success', 'Post Deleted Successfully!');
    }

    public function getComments($id)
    {
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        if (!$comments) {
            return response()->json([
                'data' => null,
                'msg' => 'No Comments',
            ]);
        }
        return response()->json([
            'data' => $comments,
            'msg' => 'Contain Comments',
        ]);
    }

    public function showEditForm($slug)
    {
        $post = Post::with(['images'])->whereSlug($slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.dashboard.edit-post', compact('post'));
    }
    public function updatePost(PostRequest $request)
    {
        $request->validated();

        try{
            DB::beginTransaction();
            $post = Post::findOrFail($request->post_id);
            $this->commentAble($request);
            $post->update($request->except(['images', '_token', 'post_id']));

            if ($request->hasFile('images')) {
                ImageManger::deleteImages($post);
                ImageManger::uploadImages($request, $post);
            }
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errros'=>$e->getMessage()]);
        }

        Session::flash('success', 'Post Updated Successfuly!');
        return redirect()->route('frontend.dashboard.profile');
    }

    private function commentAble($request)
    {
        return $request->comment_able == "on" ? $request->merge(['comment_able' => 1])
            : $request->merge(['comment_able' => 0]);
    }

    public function deletePostImage(Request $request, $image_id)
    {
        $image = Image::find($request->key);
        if (!$image) {
            return response()->json([
                'status' => '201',
                'msg' => 'Image Not Found',
            ]);
        }

        ImageManger::deleteImageFromLocal($image->path);
        $image->delete();

        return response()->json([
            'status' => 200,
            'msg' => 'image deleted successfully',
        ]);
    }
}
