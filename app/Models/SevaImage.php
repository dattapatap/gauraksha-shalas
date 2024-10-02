<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SevaImage extends Model
{
    use HasFactory;

    protected $table = 'seva_images';

    public function seva()
    {
        return $this->belongsTo(Seva::class, 'seva_id');
    }

}
