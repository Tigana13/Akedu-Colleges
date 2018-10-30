<?php

namespace App\Models\Comments;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany($this, 'commentable');
    }

}
