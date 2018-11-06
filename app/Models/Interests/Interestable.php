<?php

namespace App\Models\Interests;

use Illuminate\Database\Eloquent\Model;

class Interestable extends Model
{
    protected $table = 'interestables';
    protected $fillable = ['interests_id', 'interestables_id', 'interestables_type'];

}
