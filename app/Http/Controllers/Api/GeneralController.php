<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;

class GeneralController extends Controller
{
    public function getPosts()
    {
        $query =  Post::query()
            ->with(['user', 'category', 'admin', 'images'])
            ->activeUser()
            ->activeCategory()
            ->active();

        if(request()->query('keyword')){
            $query->where('title' ,'LIKE', '%' . request()->query('keyword') . '%');
        }
        $all_posts = clone $query->latest()->paginate(4);

        $latest_posts        = $this->latestPosts(clone $query);
        $oldest_posts        = $this->oldestPosts(clone $query);
        $popular_posts       = $this->popularPosts(clone $query);
        $most_read_posts     = $this->MostReadPosts(clone $query);
        $category_with_posts = $this->categoryWithPosts();

        $data = [
            'all_posts'           => (new PostCollection($all_posts))->response()->getData(true),
            'latest_posts'        => new PostCollection($latest_posts),
            'oldest_posts'        => new PostCollection($oldest_posts),
            'category_with_posts' => new CategoryCollection($category_with_posts),
            'popular_posts'       => new PostCollection($popular_posts),
            'most_read_posts'     => new PostCollection($most_read_posts),
        ];
        return apiResponse(200, 'Success', $data);
    }

    public function latestPosts($query)
    {
        $latest_posts = $query->latest()->take(4)->get();
        if (!$latest_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return $latest_posts;
    }
    public function oldestPosts($query)
    {
        $oldest_posts = $query->oldest()->take(3)->get();
        if (!$oldest_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return $oldest_posts;
    }
    public function popularPosts($query)
    {
        $popular_posts = $query->withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        if (!$popular_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
        return $popular_posts;
    }
    public function categoryWithPosts()
    {
        $categories = Category::active()->get();
        if (!$categories) {
            return apiResponse(404, 'Categories Not Found');
        }

        $category_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });
        return $category_with_posts;
        if (!$category_with_posts) {
            return apiResponse(404, 'Posts Not Found');
        }
    }
    public function MostReadPosts($query)
    {
        $most_read_posts = $query->orderBy('num_of_views', 'desc')->take(3)->get();
        return $most_read_posts;
    }

    public function showPost($slug)
    {
        $post = Post::with(['user', 'admin', 'category', 'images'])
            ->active()
            ->activeUser()
            ->activeCategory()
            ->whereSlug($slug)
            ->first();

        if (!$post) {
            return apiResponse(404, 'Post Not Found');
        }
        return apiResponse(200, 'this is posts', new PostResource($post));
    }

    public function getPostComments($slug)
    {
        $post = Post::active()
            ->activeUser()
            ->activeCategory()
            ->whereSlug($slug)
            ->first();

        if (!$post) {
            return apiResponse(404, 'Post Not Found');
        }

        $comments = $post->comments;
        if (!$comments) {
            return apiResponse(404, 'Comments Not Found');
        }

        return apiResponse(200, 'This Post Commetns', new CommentCollection($comments));
    }

    public function searchPosts($keyword)
    {
        return  $keyword;
    }
}
