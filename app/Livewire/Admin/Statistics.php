<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statistics extends Component
{
    public function render()
    {
        $active_categories_count = Category::whereStatus(1)->count();
        $active_posts_count = Post::whereStatus(1)->count();
        $comments_count = Comment::count();
        $active_users_count = User::whereStatus(1)->count();

        return view('livewire.admin.statistics', [
            'active_categories_count' => $active_categories_count,
            'active_posts_count' => $active_posts_count,
            'comments_count' => $comments_count,
            'active_users_count' => $active_users_count,
        ]);
    }
}
