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
        $this->products()->delete();
        $this->inquiryRequests()->delete();

        return parent::delete();
    }
}