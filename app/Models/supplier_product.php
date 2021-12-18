<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier_product extends Model
{
    use HasFactory;
    public $table = 'supplier_product';
    protected $fillable = [
        'supplier_id', 'product_id'
    ];
}
