<?php

namespace App\Models\Views;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    public function scopeViewedThisMonth($query)
    {
        $last_month = Carbon::now()->subMonths(1);
        return $query->whereDate('created_at', '>', $last_month);
    }
}
