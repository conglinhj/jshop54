<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DbCartDetail extends Pivot
{
    protected $table = "cart_detail";

    protected $touches = ['dbcart'];

    protected $fillable = [
        'cart_id', 'product_id', 'row_id', 'qty',
    ];

}
