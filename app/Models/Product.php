<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'description',
        'price',
        'stock',
        'image',
        'categories_id',
        'farmer_id'

    ];


    protected $hidden =
    [
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Farmer::class, 'farmer_id');
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class, "categories_id");
    }

    public function Orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
