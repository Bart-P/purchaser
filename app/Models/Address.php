<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name1',
        'name2',
        'name3',
        'street',
        'street_nr',
        'city_code',
        'city',
        'country',
        'phone',
    ];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}