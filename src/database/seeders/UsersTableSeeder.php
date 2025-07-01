<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => '山田 太郎',
            'email' => 'test1@example.com',
            'password' => bcrypt('password1'),
        ],
        [
            'name' => '佐藤 花子',
            'email' => 'test2@example.com',
            'password' => bcrypt('password2'),
        ],
        [
            'name' => '小林 花',
            'email' => 'test3@example.com',
            'password' => bcrypt('password3'),
        ],
        [
            'name' => '高橋 サトシ',
            'email' => 'test4@example.com',
            'password' => bcrypt('password4'),
        ],
        [
            'name' => '田中 和子',
            'email' => 'test5@example.com',
            'password' => bcrypt('password5'),
        ],

    ]);

    }
}