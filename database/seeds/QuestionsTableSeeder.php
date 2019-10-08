<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id'         => 1,
                'tag_category_id' => 1,
                'title'           => 'テスト',
                'content'         => 'これはテストです。',
                'created_at'      => Carbon::create(2019,1,1),
                'updated_at'      => Carbon::create(2019,1,2)
            ],
            [
                'user_id'         => 2,
                'tag_category_id' => 2,
                'title'           => 'テスト2',
                'content'         => 'これはテスト2です。',
                'created_at'      => Carbon::create(2019,2,1),
                'updated_at'      => Carbon::create(2019,2,2)
            ],
            [
                'user_id'         => 3,
                'tag_category_id' => 3,
                'title'           => 'テスト3',
                'content'         => 'これはテスト3です。',
                'created_at'      => Carbon::create(2019,3,1),
                'updated_at'      => Carbon::create(2019,3,2)
            ]
        ]);
    }
}
