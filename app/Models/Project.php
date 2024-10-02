<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    protected $table =  'projects';

    use HasFactory;
    use SoftDeletes;


    public function project_images()
    {
        return $this->hasMany(ProjectImage::class,'project_id')->orderBy('id', 'asc');
    }




}
