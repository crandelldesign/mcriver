<?php

namespace mcriver;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * Get the order that owns the person.
     */
    public function order()
    {
        return $this->belongsTo('mcriver\Order');
    }

    /**
     * Get active
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Get Rookies
     */
    public function scopeRookies($query, $year)
    {
        return $query->where('is_rookies', 1)->where('year', $year);
    }
}
