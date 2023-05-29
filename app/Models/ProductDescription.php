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
        'lang',
        'is_main',
        'description',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function delete()
    {
        return parent::delete();
    }
}