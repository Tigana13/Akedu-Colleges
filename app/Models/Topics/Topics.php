<?php

namespace App\Models\Topics;

use App\Models\College\College;
use App\Models\Course\Course;
use App\Models\Threads\Threads;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{

    public function threads()
    {
        return $this->morphMany(Threads::class, 'threadable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function topicable()
    {
        return $this->morphTo();
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'topicable');
    }

    public function colleges()
    {
        return $this->morphedByMany(College::class, 'topicable');
    }
}
