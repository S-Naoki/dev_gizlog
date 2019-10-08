<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('comments')->insert([
            [
                'user_id'     => 1,
                'question_id' => 1,
                'comment'     => 'テストコメント',
                'created_at'      => Carbon::create(2019,1,1)
            ],
            [
                'user_id'     => 2,
                'question_id' => 2,
                'comment'     => 'テストコメント2',
                'created_at'      => Carbon::create(2019,2,1)
            ],
            [
                'user_id'     => 3,
                'question_id' => 3,
                'comment'     => 'テストコメント3',
                'created_at'      => Carbon::create(2019,3,1)
            ]
        ]);
    }
}
