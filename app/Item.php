<?php

namespace mcriver;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
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
        return $this->belongsToMany('mcriver\Order');
    }

    /**
     * Get item by slug
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
