<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Courseable extends Model
{
    use Searchable;

    protected $fillable = ['course_id', 'courseables_type', 'courseables_id'];

    public function searchableAs()
    {
        return 'courseables_index';
    }

    public function toSearchableArray()
    {

        $array = [];

        return $array;
    }
}
