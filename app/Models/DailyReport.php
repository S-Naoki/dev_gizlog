<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class DailyReport extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time'
    ];
    protected $dates = [
        'reporting_time',
        'deleted_at'
    ];
    
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
    
    public function searchDailyReportByMonth($id, $input)
    {
        if ($input['search_month'] === null) {
            return $this->getByUserId(Auth::id());
        } else {
            return $this->where('reporting_time', 'like', '%'.$input['search_month'].'%')->where('user_id', $id)->get();
        }
    }
}
