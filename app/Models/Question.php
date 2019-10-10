<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TagCategory;
use App\Models\Comment;
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
                    ->orderby('created_at', 'asc')
                    ->get();
                    
        
    }
    
    public function searchQuestion($inputs, $tagCategoryId)
    {
        if (!empty($inputs)) {
            $questions = $this->searchQuestionByKeyWord($inputs['search_word'])
                            ->searchQuestionByTagCategory($inputs, $tagCategoryId)
                            ->orderby('created_at', 'desc')
                            ->get();
        } else {
            $questions = $this->all()->sortBy('created_at');
        }
        return $questions;
    }
    
    public function scopeSearchQuestionByTagCategory($query, $inputs, $tagCategoryId)
    {
        if (!empty($inputs['tag_category_id'])) {
            return $query->where('tag_category_id', $tagCategoryId);
        }

    }
    
    public function scopeSearchQuestionByKeyWord($query, $searchWord)
    {
        return $query->where('title', 'like', '%' .$searchWord. '%');
    }

}

