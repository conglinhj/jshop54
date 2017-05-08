<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

const ACTIVE = 1;
const DEACTIVATED = 0;

class Product extends Model
{
//    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'trademark_id',
        'category_id',
        'intro',
        'image',
        'price',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
//    protected  $dates = ['deleted_at'];

    /**
     * get the trademark that owns the product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trademark(){
        return $this->belongsTo('App\Models\Trademark');
    }

    /**
     * get the category that owns the product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function specs(){
        return $this->belongsToMany('App\Models\Specs')->withTimestamps()->withPivot('value');
    }

    /**
     * -----------------------------------------------------------------------------------------
     * for Backend
     */


    public function storeToPivotTable($array){
        $this->specs()->attach($array);
    }

    public function updateToPivotTable($id, $attribute){
        $this->specs()->updateExistingPivot($id, ['value' => $attribute]);
    }

    public function destroyToPivotTable($array){
        $this->specs()->detach($array);
    }

    /**
     * @return mixed
     */
    public function getAll(){
        return $this->latest()
            ->paginate();
    }
    public function getListWithType($type){
        return $this->where('status','=',$type)
            ->latest()
            ->paginate();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|Model|null|static|static[]
     */
    public function getDetail($id){
        return $this->with('trademark', 'specs')
            ->find($id);
    }

    /**
     * -----------------------------------------------------------------------------------------
     * for Frontend
     */


    public function getAllStatus(){
        return $this->where('status','=', ACTIVE)
            ->with([
                'trademark',
                'specs' => function($query){
                    $query->where('spotlight','=',ACTIVE)
                        ->with('hardware')
                        ->get();
                }
            ])
            ->latest()
            ->get();
    }
    public function getDetailStatus($id){
        return $this->where('status', '=', ACTIVE)
            ->with([
                'trademark',
                'specs' => function($query){
                $query->where('status','=',ACTIVE)
                    ->with('hardware')
                    ->get();
            }])
            ->find($id);
    }

    public function getListId()
    {
        return $this->select('id')->get();
    }

    public function getProductsOfTrademark($id){
        return $this->where([
            ['status', '=', ACTIVE],
            ['trademark_id', '=' , $id]
        ])->get();
    }

}
