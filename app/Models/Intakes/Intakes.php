<?php

namespace App\Models\Intakes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Intakes extends Model
{
    use Searchable;

    protected $fillable = ['college_id', 'intake_alias', 'intake_description', 'intake_start', 'intake_finish'];

    public function searchableAs()
    {
        return 'intakes_index';
    }

    public function toSearchableArray()
    {

        $array = ['intake_alias', 'intake_description', 'intake_start', 'intake_finish'];

        return $array;
    }
}
