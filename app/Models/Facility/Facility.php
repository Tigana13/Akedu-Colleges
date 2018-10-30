<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Facility extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = ['college_id', 'facility_name', 'facility_description', 'credits', 'certified'];

    public function searchableAs()
    {
        return 'facilities_index';
    }

    public function toSearchableArray()
    {

        $array = ['facility_name', 'facility_description', 'credits', 'certified'];

        return $array;
    }
}
