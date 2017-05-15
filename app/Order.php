<?php

namespace mcriver;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo('mcriver\User');
    }

    /**
     * The item that belong to the order.
     */
    public function items()
    {
        return $this->belongsToMany('mcriver\Item');
    }

    /**
     * Get the persons for the order.
     */
    public function persons()
    {
        return $this->hasMany('mcriver\Person');
    }

    /**
     * Get active
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
