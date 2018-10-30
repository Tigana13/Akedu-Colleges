<?php

namespace App;

use App\Models\Favorites\Favoritable;
use App\Models\Favorites\Favorites;
use App\Models\Interests\Interests;
use App\Models\User\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Model
{
    use Notifiable, HasApiTokens;

    protected $guarded = ['password', 'id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function searchableAs()
    {
        return 'users_index';
    }

    public function toSearchableArray()
    {

        $array = ['name', 'email'];

        return $array;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    // Each user may several favorite records
    public function favorites()
    {
        return $this->hasMany(Favoritable::class, 'user_id');
    }

    public function interests()
    {
        return $this->hasMany(Interests::class, 'user_id');
    }

}
