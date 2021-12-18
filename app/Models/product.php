<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'quantity', 'base_price', 'price'];
    public function suppliers()
    {
        return $this->belongsToMany(supplier::class, 'supplier_product');
    }
}
