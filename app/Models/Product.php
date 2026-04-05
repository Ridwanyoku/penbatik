<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'price', 'category', 'description'
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
