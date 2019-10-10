<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'tag_category_id',
        'question_id',
        'comment'
    ];
    
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
