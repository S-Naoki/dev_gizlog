<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model
{
    const SELECT_CATEGORY = 'Select Category';
    
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $table = 'tag_categories';
    protected $dates = ['deleted_at'];
    
    /**
     * collectionからカテゴリ名とカテゴリidを取得。
     *
     * @param $tagCategories
     * @return Array
     */
    public function makeTagCategoryNames($tagCategories)
    {
        return $tagCategories->pluck('name', 'id')
                             ->prepend(self::SELECT_CATEGORY)
                             ->all();
    }
}

