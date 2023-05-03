<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    // TODO description is now a separate db. 

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

    public function productDescriptions(): HasMany
    {
        return $this->hasMany(ProductDescription::class);
    }
}
