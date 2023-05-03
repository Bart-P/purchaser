<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'title',
        'order',
        'description',
        'description_list',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}