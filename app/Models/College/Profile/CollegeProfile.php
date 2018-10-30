<?php

namespace App\Models\College\Profile;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class CollegeProfile extends Model
{

    use Searchable, SoftDeletes;

    public function searchableAs()
    {
        return 'collegeprofiles_index';
    }

    public function toSearchableArray()
    {

        $array = ['college_description', 'date_founded'];

        return $array;
    }

}
