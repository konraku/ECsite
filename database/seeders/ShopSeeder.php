<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => '店名',
                'information' => '店舗情報',
                'filename' => '',
                'is_selling' => true
            ],
            [
                'owner_id' => 1,
                'name' => '店名2',
                'information' => '店舗情報2',
                'filename' => '',
                'is_selling' => true
            ],
            [
                'owner_id' => 3,
                'name' => '店名3',
                'information' => '店舗情報3',
                'filename' => '',
                'is_selling' => true
            ],
        ]);
    }
}
