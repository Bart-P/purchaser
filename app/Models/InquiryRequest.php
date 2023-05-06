<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InquiryRequest extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'inquiry_id', 'message', 'status'];

    public function inquiries(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}