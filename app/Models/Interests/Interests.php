<?php

namespace App\Models\Interests;

use App\Models\User\UserProfile;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'interest_name', 'interest_icon_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    //Relationships
    //Each interest may be liked by one or more users
    public function user()
    {
        return $this->belongsToMany(User::class, 'users');
    }

    //Each interest may be liked by one or more users
    public function user_profile()
    {
        return $this->belongsToMany(UserProfile::class, 'user_profiles');
    }

    //Each interest may have one or more sub interests
    public function subInterest()
    {
        return $this->hasMany(SubInterests::class, 'interest_id');
    }

}
