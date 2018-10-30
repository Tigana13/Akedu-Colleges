<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Countries extends Model
{
    use Searchable;

    protected $fillable = ['country_name', 'country_code', 'country_extension', 'region_code', 'continent'];

    public function searchableAs()
    {
        return 'countries_index';
    }

    public function toSearchableArray()
    {

        $array = ['country_name', 'country_code', 'country_extension', 'region_code', 'continent'];

        return $array;
    }
}
