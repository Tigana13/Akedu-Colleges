<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Imageable extends Model
{
    use Searchable;

    protected $fillable = ['image_id', 'imageable_type', 'imageable_id'];

    public function searchableAs()
    {
        return 'imageables_index';
    }

    public function toSearchableArray()
    {

        $array = [];

        return $array;
    }
}
