<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * get the product for the category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
