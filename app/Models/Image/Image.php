<?php

namespace App\Models\Image;

use App\Models\College\College;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Image extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = ['image'];

    public function searchableAs()
    {
        return 'images_index';
    }

    public function toSearchableArray()
    {
        $array = ['image'];

        return $array;
    }

    /**
     * Get all of the colleges that are associated with this image.
     */
    public function courses()
    {
        return $this->morphedByMany(College::class, 'imageable');
    }

    // Relationship
    public function imageable()
    {
        return $this->morphTo();
    }

}
