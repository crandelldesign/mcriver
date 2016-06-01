<?php

namespace mcriver;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the items for category.
     */
    public function items()
    {
        return $this->hasMany('mcriver\Item');
    }
}
