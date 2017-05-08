<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    protected $table = 'specs';

    protected $fillable = [
        'hardware_id',
        'name',
        'status',
        'spotlight',
    ];

    public function hardware(){
        return $this->belongsTo('App\Models\Hardware');
    }

    public function product(){
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }

    /**
     * get all data from specs table, sort by hardware_id
     */
    public function getAll(){
        return $this->orderBy('hardware_id')->latest()->paginate(20);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|Model
     */
    public function viewDetail($id){
        return $this->with('hardware')->FindOrFail($id);
    }


    /**
     * @return array specs_id
     */
    public function  getListId(){
        return $this->select('id')->get();
    }

    /**
     * @attach data to product_specs table
     */
    public function storeToPivotTable($proId_list)
    {
        $this->product()->attach($proId_list);
    }

    /**
     * @destroy data to product_specs table
     */
    public function destroyToPivotTable($proId_list)
    {
        $this->product()->detach($proId_list);
    }

    public function getSpecsFromHardware($id){
        return $this->where('hardware_id','=',$id)->get();
    }

}
