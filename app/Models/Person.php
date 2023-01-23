<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'gender',
        'firstName',
        'lastName',
        'position',
        'phone1',
        'phone2',
        'email1',
        'email2',
    ];

    public function suppliers(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }
}