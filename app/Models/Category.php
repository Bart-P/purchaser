<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function delete()
    {
        $this->suppliers()->each(function ($supp) {
            $supp->categories()->detach($this->id);
        });
        $this->tags()->delete();

        return parent::delete();
    }
}