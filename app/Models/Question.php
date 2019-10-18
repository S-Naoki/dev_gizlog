<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use softDeletes;
    
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];
    
    protected $dates = [
        'deleted_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function fetchQuestionsByUserId($id)
    {
        return $this->where('user_id', $id)
                    ->orderby('created_at', 'desc')
                    ->with('tagCategory', 'comments')
                    ->get();
    }
    
    public function searchQuestions($inputs)
    {
            return $this->searchQuestionsByKeyWord($inputs)
                        ->searchQuestionsByTagCategory($inputs)
                        ->orderby('created_at', 'desc')
                        ->with('user', 'tagCategory', 'comments')
                        ->get();
    }
    
    public function scopeSearchQuestionsByTagCategory($query, $inputs)
    {
        if (!empty($inputs['search_category_id'])) {
            return $query->where('tag_category_id', $inputs['search_category_id']);
        }
    }
    
    public function scopeSearchQuestionsByKeyWord($query, $inputs)
    {
        if (!empty($inputs['search_word'])) {
            return $query->where('title', 'like', '%' .$inputs['search_word']. '%');
        }
    }
}
