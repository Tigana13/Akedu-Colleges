<?php

namespace App\Models\Locations;

use App\Models\College\College;
use App\Models\Countries\Countries;
use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Locations extends Model
{
    use Searchable;

    protected $fillable = ['latitude', 'longitude', 'address', 'country_id', 'city'];

    public function searchableAs()
    {
        return 'locations_index';
    }

    public function toSearchableArray()
    {

        $array = ['latitude', 'longitude', 'address', 'city'];

        return $array;
    }


    /**
     * Get all of the colleges that are associated this location.
     */
    public function colleges()
    {
        return $this->morphedByMany(College::class, 'locatable');
    }

    /**
     * Get all of the courses that are associated to this location.
     */
    public function courses()
    {
        return $this->morphedByMany(Course::class, 'locatable');
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

}
