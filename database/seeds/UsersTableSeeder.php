<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'のっち',
                "mail" => "nnn@nnn",
                "password" => Hash::make("nnn333"),
                "bio" => "こどものっち",
                "images" => "Atlas.png"],
            [
                'username' => '西脇',
                "mail" => "aaa@aaa",
                "password" => Hash::make("aaa333"),
                "bio" => "きになる姫",
                "images" => "Atlas.png"
            ],
            [
                'username' => 'ゆか',
                "mail" => "yyy@yyy",
                "password" => Hash::make("yyy333"),
                "bio" => "ログイン",
                "images" => "Atlas.png"
            ]
        ]);
    }
}
