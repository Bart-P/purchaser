<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function categoryJunctions(): HasMany
    {
        return $this->hasMany(SupplierCategoryJunction::class);
    }

    public function delete(): ?bool
    {
        $this->addresses()->delete();
        $this->persons()->delete();

        return parent::delete();
    }
}