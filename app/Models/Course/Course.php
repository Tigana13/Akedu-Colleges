<?php

namespace App\Models\Course;

use App\Models\College\College;
use App\Models\Comments\Comments;
use App\Models\Course\Profile\CourseProfile;
use App\Models\ExitSurvey\ExitSurvey;
use App\Models\Intakes\Intakes;
use App\Models\Locations\Locations;
use App\Models\Threads\Threads;
use App\Models\Topics\Topics;
use App\Models\Views\Views;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Course extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = ['course_name', 'college_id', 'course_intake'];

    public function searchableAs()
    {
        return 'courses_index';
    }

    public function toSearchableArray()
    {

        $array = ['course_name', 'certified'];

        return $array;
    }

    public function profile()
    {
        return $this->hasOne(CourseProfile::class,'course_id');
    }

    public function intakes()
    {
        return $this->hasMany(Intakes::class, 'id', 'course_intake');
    }

    /**
     * Get all of the colleges that are associated with this course.
     */
    public function colleges()
    {
        return $this->morphedByMany(College::class, 'courseables');
    }

    public function topics()
    {
        return $this->morphMany(Topics::class, 'topicable');
    }

    public function threads()
    {
        return $this->morphMany(Threads::class, 'threadable');
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function views()
    {
        return $this->morphMany(Views::class, 'viewable');
    }

    public function offeringBranches()
    {
        return $this->morphToMany(Locations::class, 'locatable');
    }

    public function exitSurveys()
    {
        return $this->hasMany(ExitSurvey::class, 'course_id');
    }

    public function scopeViewedThisMonth($query)
    {
        $last_month = Carbon::now()->subMonths(1);

        return $query->whereHas('views', function ($query) use ($last_month){
            return $query->whereDate('created_at', '>', $last_month);
        });
    }
}
