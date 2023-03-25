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

    public function saveAddresses($addresses): void
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

    public function savePersons($persons): void
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

    public function createCategoryJunctions($categories): void
    {
        foreach ($categories as $category) {
            $this->createSingleCategoryJunction($category['id']);
        }
    }

    public function createSingleCategoryJunction($categoryId): void
    {
        SupplierCategoryJunction::create(
            [
                'supplier_id' => $this->id,
                'category_id' => $categoryId,
            ]
        );
    }

    /**
     * compares categories with junctions for supplier
     * then deletes or creates a new junction depending on the difference
     *
     * @param array $categories
     *
     * @return void
     */
    public function updateCategoryJunctions(array $categories): void
    {
        $junctions = $this->categoryJunctions()->get();

        $requestCategoryIds = array_map(function ($cat) {
            return $cat['id'];
        }, array_values($categories));

        $junctionIds = array_map(function ($jun) {
            return $jun['category_id'];
        }, array_values($junctions->toArray()));

        $junctionsToCreate = array_diff($requestCategoryIds, $junctionIds);
        $junctionsToDelete = array_diff($junctionIds, $requestCategoryIds);

        foreach ($junctionsToCreate as $categoryId) {
            $this->createSingleCategoryJunction($categoryId);
        }

        foreach ($junctionsToDelete as $categoryId) {
            SupplierCategoryJunction::destroy($junctions->where('category_id', 'like', $categoryId));
        }
    }

    public function tagJunctions(): HasMany
    {
        return $this->hasMany(SupplierTagJunction::class);
    }

    public function delete(): ?bool
    {
        $this->addresses()->delete();
        $this->persons()->delete();
        $this->categoryJunctions()->delete();

        return parent::delete();
    }
}

