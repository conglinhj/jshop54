<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    const ACTIVE = 1;
    const DEACTIVATED = 0;
//    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'trademark_id', 'category_id', 'intro', 'image', 'price',
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
    public function trademark()
    {
        return $this->belongsTo('App\Models\Trademark');
    }

    /**
     * get the category that owns the product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function dbcart()
    {
        return $this->belongsToMany(DbCart::class, 'cart_detail', 'product_id')->withPivot('row_id', 'qty');
    }

    public function specs()
    {
        return $this->belongsToMany('App\Models\Specs')->withTimestamps()->withPivot('value');
    }

    public function order() {
        return $this->belongsToMany(Order::class, 'order_details', 'product_id')->withPivot('quantity', 'price', 'discount');
    }

    public function user() {
        return $this->belongsToMany(User::class, 'wishlist', 'product_id')->withTimestamps();
    }

    public function product() {
        return $this->belongsToMany(PhieuNhap::class, 'chitiet_phieunhap', 'product_id')->withPivot('quantity', 'price');
    }

    /**
     * -----------------------------------------------------------------------------------------
     * for Backend
     */

    public function storeToPivotTable($array)
    {
        $this->specs()->attach($array);
    }

    public function updateToPivotTable($id, $attribute)
    {
        $this->specs()->updateExistingPivot($id, ['value' => $attribute]);
    }

    public function destroyToPivotTable($array)
    {
        $this->specs()->detach($array);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->latest()
            ->paginate();
    }

    public function getListWithType($type)
    {
        return $this->where('status', '=', $type)
            ->latest()
            ->paginate();
    }

    public function getListWithCategory($id)
    {
        return $this->where('category_id', '=', $id)
            ->latest()
            ->paginate();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|Model|null|static|static[]
     */
    public function getDetail($id)
    {
        return $this->with('trademark', 'specs')
            ->find($id);
    }

    public function getListId()
    {
        return $this->select('id')->get();
    }

    /**
     * -----------------------------------------------------------------------------------------
     * for Frontend
     */

    public function isActive()
    {
        return $this->where([
                ['status', '=', self::ACTIVE],
                ['quantity', '>', 0],
            ])->with(['user',
                'trademark',
                'specs' => function ($query) {
                    $query->where('spotlight', '=', self::ACTIVE)
                        ->with('hardware');
                }
            ])
            ->latest()
            ->paginate(12);
    }

    public function isActiveOfCategory($cate_id)
    {
        return $this->where([
                ['status', '=', self::ACTIVE],
                ['category_id', '=', $cate_id],
                ['quantity', '>', 0],
            ])->with(['user',
                'trademark',
                'specs' => function ($query) {
                    $query->where('spotlight', '=', self::ACTIVE)
                        ->with('hardware');
                }
            ])
            ->latest()
            ->paginate(12);
    }

    public function getDetailProductIsActive($id)
    {
        return $this->where('status', '=', self::ACTIVE)
            ->with(['user',
                'trademark',
                'specs' => function ($query) {
                    $query->where('status', '=', self::ACTIVE)
                        ->with('hardware')
                        ->get();
                }])
            ->find($id);
    }

    public function getProductsOfTrademarkAndCategory($category ,$id)
    {
        return $this->where([
            ['status', '=', self::ACTIVE],
            ['category_id', '=', $category],
            ['trademark_id', '=', $id],
            ['quantity', '>', 0],
        ])->paginate(12);
    }

    public function getProductsOfTrademark($id)
    {
        return $this->where([
            ['status', '=', self::ACTIVE],
            ['trademark_id', '=', $id],
            ['quantity', '>', 0],
        ])->with(['user',
            'trademark',
            'specs' => function ($query) {
                $query->where('status', '=', self::ACTIVE)
                    ->with('hardware')
                    ->get();
            }])->paginate(12);
    }

    public function searchProductIsActive($key_search)
    {
        return $this->where([
            ['status', '=', self::ACTIVE],
            ['name', 'like', '%' . $key_search . '%'],
        ])
            ->paginate(12);
    }

    public function getProductWithPrice($category,$key = 0)
    {
        switch ($key) {
            case 1:
                return $this->where([
                        ['price', '>=', 0],
                        ['price', '<', 10000000],
                        ['category_id', '=', $category],
                        ['quantity', '>', 0],
                    ])->orderBy('price')->paginate(12);
                break;
            case 2:
                return $this->where([
                        ['price', '>=', 10000000],
                        ['price', '<', 15000000],
                        ['category_id', '=', $category],
                        ['quantity', '>', 0],
                    ])->orderBy('price')->paginate(12);
                break;
            case 3:
                return $this->where([
                        ['price', '>=', 15000000],
                        ['price', '<', 20000000],
                        ['category_id', '=', $category],
                        ['quantity', '>', 0],
                ])->orderBy('price')->paginate(12);
                break;
            case 4:
                return $this->where([
                        ['price', '>=', 20000000],
                        ['category_id', '=', $category],
                        ['quantity', '>', 0],
                    ])->orderBy('price')->paginate(12);
                break;
            default:
                return $this->where([
                        ['price', '>=', 0],
                        ['category_id', '=', $category],
                        ['quantity', '>', 0],
                ])->paginate(12);
                break;
        }

    }
}
