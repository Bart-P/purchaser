<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierCategoryJunction extends Model
{
    use HasFactory;

    protected $table = 'supplier_category_junction';
    protected $fillable = ['supplier_id', 'category_id'];
    public $timestamps = false;
}