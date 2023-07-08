<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,  'category_id', 'id');
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }
}
