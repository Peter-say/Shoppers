<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class,  'category_id', 'id');
    }

    public function cartItem()
    {
        return $this->hasOne(CartItem::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function Store()
    {
        return $this->belongsTo(Store::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
