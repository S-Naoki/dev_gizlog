<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model
{
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
    public function fetchTagCategories($tagCategories)
    {
            return $tagCategories->pluck('name', 'id')
                                 ->prepend('Select Category', 0)
                                 ->all();
    }
}

