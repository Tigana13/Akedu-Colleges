<?php

namespace App\Models\Course\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class CourseProfile extends Model
{
    use Searchable;

    protected $fillable = ['course_description', 'course_credits', 'course_qualifications', 'course_duration'];

    public function searchableAs()
    {
        return 'courseprofiles_index';
    }

    public function toSearchableArray()
    {

        $array = ['course_description', 'course_credits', 'course_qualifications', 'course_duration'];

        return $array;
    }
}
