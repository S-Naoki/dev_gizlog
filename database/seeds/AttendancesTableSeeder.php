<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->truncate();
        DB::table('attendances')->insert([
            [
                'user_id'         => 1,
                'date'            => Carbon::create(2019, 10, 23),
                'start_time'      => Carbon::create(2019, 10, 23, 9, 00, 00),
                'end_time'        => Carbon::create(2019, 10, 23, 18, 00, 00),
                'absence_state'   => 0,
                'absence_reason'  => null,
                'request_state'   => 0,
                'request_content' => null
            ],
            [
                'user_id'         => 2,
                'date'            => Carbon::create(2019, 10, 23),
                'start_time'      => Carbon::create(2019, 10, 23, 10, 00, 00),
                'end_time'        => Carbon::create(2019, 10, 23, 19, 00, 00),
                'absence_state'   => 0,
                'absence_reason'  => 'おはようございます。昨晩から、体調が優れなくて、現在とても出社できる状況ではない為、本日は出勤を控えさせて頂きたいです。',
                'request_state'   => 1,
                'request_content' => '申し訳ありません。出社の打刻を忘れてしまいました。9:50に出社しましたので、修正お願いします。'
            ],
            [
                'user_id'         => 4,
                'date'            => Carbon::create(2019, 10, 23),
                'start_time'      => Carbon::create(2019, 10, 23, 11, 00, 00),
                'end_time'        => Carbon::create(2019, 10, 23, 20, 00, 00),
                'absence_state'   => 0,
                'absence_reason'  => null,
                'request_state'   => 0,
                'request_content' => null
            ],
        ]);
    }
}
