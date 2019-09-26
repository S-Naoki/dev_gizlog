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
    
    public function searchDailyReportByMonth($input)
    {
        if (!empty($input['search_month']) || $input['search_month'] === null) {
            return $this->where('reporting_time', 'like', '%'.$input['search_month'].'%')->get();
        }
    }
}
