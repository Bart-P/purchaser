<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'inquiry_id',
        'description',
    ];

    public function inquiries(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }
}
