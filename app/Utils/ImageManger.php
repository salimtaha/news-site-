<?php
namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageManger{

    public static function uploadImages($request , $post=null , $user=null)
    {
        if($request->hasFile('images')){
            foreach($request->images as $image){

                $file = self::generateImageName($image);
                $path = self::storeImageInLocal($image , 'posts' , $file);

                $post->images()->create([
                    'path'=>$path,
                ]);
            }
        }

        // upload single image
        if($request->hasFile('image')){
            $image = $request->file('image');

            self::deleteImageFromLocal($user->image);

            $file = self::generateImageName($image);
            $path = self::storeImageInLocal($image , 'users' , $file);

            $user->update(['image'=>$path]);
        }
    }

    public static function deleteImages($post)
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
               self::deleteImageFromLocal($image->path);
               $image->delete();
            }
        }
    }

    public static function generateImageName($image)
    {
        $file = Str::uuid() . time() . $image->getClientOriginalExtension();
        return $file;
    }
    public static function storeImageInLocal($image , $path , $file_name)
    {
        $path = $image->storeAs('uploads/'.$path , $file_name , ['disk'=>'uploads']);
        return $path;
    }
    public static function deleteImageFromLocal($image_path)
    {
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
    }

}
