<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time',
        'body'
    ];
    
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
    
    protected $dates = [
        'reporting_time',
        'deleted_at'
    ];
}
