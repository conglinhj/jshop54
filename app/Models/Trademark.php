<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'active'
    ];

    /**
     * get the product for the trademark
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        return $this->hasMany('App\Models\Product');
    }

    public function getAll(){
        return $this->latest()
            ->paginate(15);
    }
    public function viewDetail($id){
        return $this->find($id);
    }

    /**
     *  for frontend
     */

    public function activating(){
        return $this->where('active','=',1)->get();
    }

}
