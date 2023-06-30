<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                "user_id" => "23001",
                "post" => "日焼け後"],
            [
                "user_id" => "23002",
                "post" => "あやねっと",
            ],
            [
                "user_id" => "23003",
                "post" => "電車で隣に乗りたい",
            ]
        ]);
    }
}
