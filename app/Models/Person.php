<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    public $table = 'persons';
    protected $fillable = [
        'type',
        'gender',
        'first_name',
        'last_name',
        'position',
        'phone1',
        'phone2',
        'email1',
        'email2',
    ];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}