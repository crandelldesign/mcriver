<?php

namespace mcriver;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the category that owns the item.
     */
    public function category()
    {
        return $this->belongsTo('mcriver\Category');
    }

    /**
     * Get the children for item.
     */
    public function children()
    {
    	return $this->hasMany('mcriver\Item','parent_id');
	}

	/**
     * Get the parent for child.
     */
	public function parent()
	{
	    return $this->belongsTo('mcriver\Item','parent_id');
	}

    /**
     * The order that belong to the item.
     */
    public function orders()
    {
        return $this->belongsToMany('mcriver\Order')->withTimestamps();
    }

    /**
     * Get item by slug
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
