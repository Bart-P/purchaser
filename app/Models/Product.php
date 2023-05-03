<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    // TODO what to do about description? 
    // 1. either 3 in DB for each Product 
    // 2. or separate table, each Product can have 5 Descriptions if needed

    protected $fillable = [
        'title',
        'inquiry_id',
    ];

    public function inquiries(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function productPrices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }
}
