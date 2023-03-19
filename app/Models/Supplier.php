<?php

namespace App\Models;

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PersonController;
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

    public function saveAddresses($addresses)
    {
        if ($addresses) {
            $addressesArray = AddressController::getArrayOfAddressObjects($addresses, $this->id);
            $this->addresses()->saveMany($addressesArray);
        };
    }

    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function savePersons($persons)
    {
        if ($persons) {
            $personsArray = PersonController::getArrayOfPersonObjects($persons, $this->id);
            $this->persons()->saveMany($personsArray);
        }
    }

    public function categoryJunctions(): HasMany
    {
        return $this->hasMany(SupplierCategoryJunction::class);
    }

    public function createCategoryJunctions($categories)
    {
        foreach ($categories as $category) {
            SupplierCategoryJunction::create(
                [
                    'supplier_id' => $this->id,
                    'category_id' => $category['id'],
                ]
            );
        }
    }

    public function delete(): ?bool
    {
        $this->addresses()->delete();
        $this->persons()->delete();
        $this->categoryJunctions()->delete();

        return parent::delete();
    }
}