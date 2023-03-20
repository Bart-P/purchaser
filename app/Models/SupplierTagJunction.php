<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTagJunction extends Model
{
    use HasFactory;

    protected $table = 'supplier_tag_junction';
    protected $fillable = ['supplier_id', 'tag_id'];
    public $timestamps = false;
}