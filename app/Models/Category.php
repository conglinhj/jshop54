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
        'status',
    ];

    /**
     * get the product for the category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        return $this->hasMany('App\Models\Product');
    }

    public function getList()
    {
        return $this->latest('updated_at')
            ->paginate();
    }
    public function getAll()
    {
        return $this->get();
    }

    public function getDetails($id)
    {
        return $this->findOrFail($id);
    }
}
