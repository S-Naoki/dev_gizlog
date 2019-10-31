<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'absence_state',
        'absence_reason',
        'request_state',
        'request_content'
    ];
    
    protected $dates = [
        'date',
        'start_time',
        'end_time',
        'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function fetchAttendance($attendanceId, $nowTime)
    {
        return $this->where('date', $nowTime)->where('user_id',$attendanceId)->first();
    }
    
    public function getMyAttendancesByUserId($userId)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }
    
}
