<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['technology category' , 'sports category' , 'fashoin category' , 'News Category'];
        $date = fake()->date('Y-m-d h:m:s');
        foreach($data as $item){
            Category::create([
                'name'=>$item ,
                'slug'=>Str::slug($item),
                'status'=>1,
                'created_at'=>$date,
                'updated_at'=>$date,
            ]);
        }
    }
}
