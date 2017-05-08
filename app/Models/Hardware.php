<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Hardware extends Model
{

    protected $fillable = [
        'name',
        'status',
    ];

    public function specs()
    {
        return $this->hasMany('App\Models\Specs');
    }



    public function getList()
    {
        return $this->latest('updated_at')
            ->paginate();
    }
    public function getAll()
    {
        return $this->with('specs')
            ->get();
    }

    public function getDetails($id)
    {
        return $this->findOrFail($id);
    }
}
