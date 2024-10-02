<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seva extends Model
{

    protected $table =  'sevas';

    use HasFactory;
    use SoftDeletes;


    public function seva_images()
    {
        return $this->hasMany(SevaImage::class,'seva_id')->orderBy('id', 'asc');
    }




}
