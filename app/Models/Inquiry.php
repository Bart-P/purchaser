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
        'offers_until',
        'delivery_date',
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function inquiryRequests(): HasMany
    {
        return $this->hasMany(InquiryRequest::class);
    }

    public function delete()
    {
        // By calling delete on products, the products themself are deleted but
        // not the relations of products. Through calling delete on each product
        // individually this problem is bypassed and relations are deleted as
        // well. 
        foreach ($this->products()->get() as $product) {
            $product->delete();
        };
        $this->inquiryRequests()->delete();

        return parent::delete();
    }
}
