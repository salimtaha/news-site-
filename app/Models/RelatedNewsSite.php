<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedNewsSite extends Model
{
    use HasFactory;
    protected $table = 'related_sites';
    protected $fillable = ['name' , 'url'];


    public static function filterRequest() : array
    {
        return [
            'name'=>['required' , 'string' , 'max:40'],
            'url'=>['url' , 'required'],
        ];
    }
}
