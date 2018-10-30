<?php

namespace App\Models\User;

use App\Models\Interests\Interests;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInterests extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'interest_id', 'sub_interest_id', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    //Relationships
    //Each interest belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Each interest belongs to a user profile
    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id');
    }

    //Each user interest belongs to an interest
    public function interest()
    {
        return $this->belongsTo(Interests::class, 'interest_id');
    }
}
