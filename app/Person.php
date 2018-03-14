<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $table = 'persons';

    /**
     * Get the order that owns the person.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
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
    public function scopeRookie($query, $year)
    {
        return $query->where('is_rookie', 1)->where('year', $year);
    }
}
