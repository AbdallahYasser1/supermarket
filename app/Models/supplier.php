<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $table = "supplier";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'address', 'phonenumber'];
    function products()
    {
        return $this->belongsToMany(product::class, 'supplier_product');
    }
}
