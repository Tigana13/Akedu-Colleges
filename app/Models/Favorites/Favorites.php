<?php

namespace App\Models\Favorites;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'favorite_description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    //Get all of the favoritable models
    public function favoritable()
    {
        return $this->morphTo();
    }

    // Relationships
    // Each favorite belongs to a user
    public function user()
    {
        return $this->morphedByMany(User::class, 'favoritable');
    }

}
