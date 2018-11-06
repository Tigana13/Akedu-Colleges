<?php

namespace App\Models\College;

use App\Models\College\Profile\CollegeProfile;
use App\Models\Comments\Comments;
use App\Models\Course\Course;
use App\Models\Facility\Facility;
use App\Models\Image\Image;
use App\Models\Intakes\Intakes;
use App\Models\Locations\Locations;
use App\Models\Threads\Threads;
use App\Models\Topics\Topics;
use App\Models\Views\Views;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class College extends Authenticatable
{
    use Searchable, SoftDeletes;

    public function searchableAs()
    {
        return 'colleges_index';
    }

    public function toSearchableArray()
    {
        $array = ['college_name'];

        return $array;
    }

    public function profile()
    {
        return $this->hasOne(CollegeProfile::class, 'college_id');
    }

    public function intakes()
    {
        return $this->hasMany(Intakes::class, 'college_id');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'college_id');
    }

    public function locations()
    {
        return $this->morphToMany(Locations::class, 'locatable');
    }

    //Each college may be tied to one or more courses aps
    public function courses()
    {
        return $this->morphToMany(Course::class, 'courseables');
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function bannerimages()
    {
        return $this->hasMany(Image::class, 'college_id');
    }


    public function topics()
    {
        return $this->morphMany(Topics::class, 'topicable');
    }

    public function threads()
    {
        return $this->morphMany(Threads::class, 'threadable');
    }

    public function views()
    {
        return $this->morphMany(Views::class, 'viewable');
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

}
