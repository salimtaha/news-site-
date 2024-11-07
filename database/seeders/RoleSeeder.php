<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permessions = [];
        foreach(config('authorization.permessions') as $permession=>$value){
            $permessions[] = $permession;
        }

        Authorization::create([
            'role'=>'Manager',
            'permessions'=>json_encode($permessions),
        ]);
    }
}
