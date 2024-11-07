<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::active()->get();
        if(!$categories){
            return apiResponse(404 , 'No Categories');
        }
        return apiResponse(200 , 'All Categories' , new CategoryCollection($categories));
    }
    public function getCategoryPosts($slug)
    {

        $category = Category::whereSlug($slug)->first();

        if(!$category){
            return apiResponse(404 , 'Category Not Found');
        }
        $posts = $category->posts;

        return apiResponse(200 , 'This is Category Posts' , new PostCollection($posts));
    }
}
