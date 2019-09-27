<?php

use Illuminate\Database\Seeder;

class DailyReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        DB::table('daily_reports')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => '朝ごはん',
                'content' => '今日は朝ごはんを食べました。',
                'reporting_time' => Carbon::create(2019,1,1),
                'created_at' => Carbon::create(2019, 1, 1),
                'updated_at' => Carbon::create(2019, 1, 2)
    
            ],
            [
                'id' => 2,
                'user_id' => 4,
                'title' => 'テストタイトル',
                'content' => 'テスト内容',
                'reporting_time' => Carbon::create(2019,1,2),
                'created_at' => Carbon::create(2019, 1, 3),
                'updated_at' => Carbon::create(2019, 1, 4)
            ]
        ]);
    }
}
