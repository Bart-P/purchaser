<?php

namespace App\Models;

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PersonController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'web',
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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function updateCategoryPivot(array $categegory_ids)
    {
        $this->categories()->sync($categegory_ids);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function updateTagPivot(array $tag_ids)
    {
        $this->tags()->sync($tag_ids);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function inquiryRequests(): HasMany
    {
        return $this->hasMany(InquiryRequest::class);
    }

    public function delete(): ?bool
    {
        $this->addresses()->delete();
        $this->persons()->delete();
        $this->categories()->detach();
        $this->tags()->detach();
        $this->inquiryRequests()->delete();

        return parent::delete();
    }
}