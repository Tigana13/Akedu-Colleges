<?php

namespace App\Models\User;

use App\Models\College\College;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class UserProfile extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = ['user_id', 'dob', 'occupation', 'college_id', 'completion_year'];

    public function searchableAs()
    {
        return 'userprofiles_index';
    }

    public function toSearchableArray()
    {
        $array = ['dob', 'occupation', 'completion_year'];

        return $array;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

}
