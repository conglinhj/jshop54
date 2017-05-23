<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    protected $table = 'phieunhap';

    protected $fillable = [
        'provider_id'
    ];

    public function provider() {
        return $this->belongsTo(Provider::class);
    }

    public function product() {
        return $this->belongsToMany(Product::class, 'chitiet_phieunhap', 'phieunhap_id')->withPivot('quantity', 'price');
    }

}
