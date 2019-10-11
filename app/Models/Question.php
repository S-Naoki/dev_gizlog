<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use softDeletes;
    
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'tag_category_id',
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
                    ->get();
    }
    
    public function searchQuestions($inputs, $tagCategoryId)
    {
        if (!empty($inputs)) {
            return $this->searchQuestionsByKeyWord($inputs['search_word'])
                        ->searchQuestionsByTagCategory($inputs['tag_category_id'], $tagCategoryId)
                        ->orderby('created_at', 'desc')
                        ->get();
        }
        return $this->all()->sortByDesc('created_at');
    }
    
    public function scopeSearchQuestionsByTagCategory($query, $tagCategoryId)
    {
        if (!empty($tagCategoryId)) {
            return $query->where('tag_category_id', $tagCategoryId);
        }

    }
    
    public function scopeSearchQuestionsByKeyWord($query, $searchWord)
    {
        if (!empty($searchWord)) {
            return $query->where('title', 'like', '%' .$searchWord. '%');
        }
    }
}
