<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'project',
        'pm',
        'client',
    ];

    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }
}