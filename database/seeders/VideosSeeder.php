<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Random names:
        $names = ['John Weeks Dev', 'Jane Doe', 'John Doe', 'Jane Weeks Dev', 'John Smith', 'Jane Smith', 'John Weeks', 'Jane Weeks', 'John Doe Dev', 'Jane Doe Dev', 
        ];

        DB::table('videos')->insert([
            'title' => 'Traffic in the city',
            'thumbnail' => '/videos/Thumbnails/vid-1.png',
            'video' => '/videos/vid-1.mp4',
            'user' => 'Andres Figueroa',
            'views' => '34k',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('videos')->insert([
            'title' => 'Cool city',
            'thumbnail' => '/videos/Thumbnails/vid-2.png',
            'video' => '/videos/vid-2.mp4',
            'user' => 'Jose Pérez',
            'views' => '89k',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('videos')->insert([
            'title' => 'Night in the city',
            'thumbnail' => '/videos/Thumbnails/vid-3.png',
            'video' => '/videos/vid-3.mp4',
            'user' => 'Antonio López',
            'views' => '4k',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('videos')->insert([
            'title' => 'Landscapes of the city',
            'thumbnail' => '/videos/Thumbnails/vid-4.png',
            'video' => '/videos/vid-4.mp4',
            'user' => 'Maria González',
            'views' => '728k',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('videos')->insert([
            'title' => 'City at sunset',
            'thumbnail' => '/videos/Thumbnails/vid-5.png',
            'video' => '/videos/vid-5.mp4',
            'user' => 'Jesus Martinez',
            'views' => '84k',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        
    }
}
