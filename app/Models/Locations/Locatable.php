<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Locatable extends Model
{
    use Searchable;

    protected $fillable = ['locations_id', 'locatable_type', 'locatable_id'];

    public function searchableAs()
    {
        return 'locatables_index';
    }

    public function toSearchableArray()
    {

        $array = ['latitude', 'longitude', 'address', 'city'];

        return $array;
    }


}
