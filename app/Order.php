<?php

namespace mcriver;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
        return $this->belongsToMany('mcriver\Item')->withTimestamps();
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
