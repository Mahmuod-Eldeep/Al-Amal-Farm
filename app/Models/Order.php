<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'Number_of_pieces_in_order',
        'Status',
        'product_id',
        'user_id'
    ];



    protected $casts = [
        'Status' => 'boolean'
    ];


    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
