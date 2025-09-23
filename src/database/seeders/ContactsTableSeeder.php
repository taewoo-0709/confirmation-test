<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use App\Models\User;

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        $baseContacts = [
            1 => ['last_name'=>'山田','first_name'=>'太郎','gender'=>1,'tel'=>'09012345678','address'=>'東京都渋谷区'],
            2 => ['last_name'=>'佐藤','first_name'=>'花子','gender'=>2,'tel'=>'09023456789','address'=>'東京都新宿区'],
            3 => ['last_name'=>'小林','first_name'=>'花','gender'=>2,'tel'=>'09034567890','address'=>'東京都世田谷区'],
            4 => ['last_name'=>'高橋','first_name'=>'サトシ','gender'=>1,'tel'=>'09045678901','address'=>'東京都中野区'],
            5 => ['last_name'=>'田中','first_name'=>'和子','gender'=>3,'tel'=>'08056789012','address'=>'東京都大田区'],
        ];

        $detailTexts = [
        1 => ['商品が届きません。'],
        2 => ['商品が破損していました。'],
        3 => ['商品が注文と違う物でした。'],
        4 => ['ショップの営業時間を教えてください。'],
        5 => ['その他の問い合わせ'],
        ];

        $userIds = array_keys($baseContacts);
        $categoryIds = [1,2,3,4,5];

        for ($i = 0; $i < 35; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $categoryId = $categoryIds[array_rand($categoryIds)];
            $base = $baseContacts[$userId];
            $email = User::find($userId)->email;
            $detail = $detailTexts[$categoryId][array_rand($detailTexts[$categoryId])];

            Contact::factory()->create(array_merge($base, [
                'user_id' => $userId,
                'category_id' => $categoryId,
                'email' => $email,
                'detail' => $detail,
            ]));
        }
    }
}