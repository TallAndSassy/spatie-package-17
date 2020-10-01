<?php

namespace Spatie\Skeleton\Models;

use Illuminate\Database\Eloquent\Model;

class SkeletonModel extends Model
{
    public $gaurded = [];// Defualt to no mass assignements
    public $fillable = ['name'];
    public $table = 'skeleton';

    public function getUpperCasedName() : string
    {
        return strtoupper($this->name);
    }
}
