<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedNewsResource;
use App\Models\RelatedNewsSite;
use Illuminate\Http\Request;

class RelatedNewsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $related_news = RelatedNewsSite::get();

        if(!$related_news){
            return apiResponse(404 , 'Related News Is Empty');
        }
        return apiResponse(200 , 'this is related news' ,
         ['related_news'=>RelatedNewsResource::collection($related_news)]);
    }
}
