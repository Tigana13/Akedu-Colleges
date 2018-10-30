<?php

namespace App\Models\Favorites;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Favoritable extends Model
{
    use Searchable;

    protected $fillable = [];

    public function searchableAs()
    {
        return 'favoritables_index';
    }

    public function toSearchableArray()
    {

        $array = [];

        return $array;
    }
}
