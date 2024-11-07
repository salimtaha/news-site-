<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CasheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.'/
     */
    public function boot(): void
    {

        //  read more posts
        if(!Cache::has('read_more_posts')){
            $read_more_posts = Post::active()->select('id' ,'title' , 'slug')->latest()->limit(10)->get();
            Cache::remember('read_more_posts' , 3600, function() use($read_more_posts){
                return $read_more_posts;
            });
        }

        // latest posts
        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::with('images')->select('id', 'title', 'slug')->latest()->limit(5)->get();
            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });
        }

        // gretest_posts_comments
        if (!Cache::has('gretest_posts_comments')) {
            $gretest_posts_comments = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();

            Cache::remember('gretest_posts_comments', 3600, function () use ($gretest_posts_comments) {
                return $gretest_posts_comments;
            });
        }

        // get data from cache
        $read_more_posts = Cache::get('read_more_posts');
        $latest_posts = Cache::get('latest_posts');
        $gretest_posts_comments = Cache::get('gretest_posts_comments');


        // share data in views
        view()->share([
            'read_more_posts' =>$read_more_posts,
            'latest_posts' => $latest_posts,
            'gretest_posts_comments' => $gretest_posts_comments,
        ]);
    }
}
