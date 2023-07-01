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
                "password" => Hash::make("nnnn3333"),
                "bio" => "こどものっち",
                "images" => "ダーク系.jpg"],
            [
                'username' => '西脇',
                "mail" => "aaa@aaa",
                "password" => Hash::make("aaaa3333"),
                "bio" => "きになる姫",
                "images" => "A-chan.jpg"
            ],
            [
                'username' => 'ゆか',
                "mail" => "yyy@yyy",
                "password" => Hash::make("yyyy3333"),
                "bio" => "ログイン",
                "images" => "atlas.png"
            ]
        ]);
    }
}
