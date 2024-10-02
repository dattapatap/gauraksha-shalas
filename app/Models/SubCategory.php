<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    use HasFactory;


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function collections()
    {
        return $this->hasMany(CategoryType::class, 'sub_category_id')->where('status', true);
    }
}
