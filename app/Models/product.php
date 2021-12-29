<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'quantity', 'price', 'image'];
    public function suppliers()
    {
        return $this->belongsToMany(supplier::class, 'supplier_product');
    }
    public function sales()
    {
        return $this->hasMany(sales::class);
    }
}
