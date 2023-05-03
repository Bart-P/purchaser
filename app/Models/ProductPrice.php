<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'note',
        'cost_in_cent',
        'price_in_cent',
    ];

    public function inquiries(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
