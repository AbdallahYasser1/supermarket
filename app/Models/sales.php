<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;

    public $table = 'sales';
    protected $fillable = ['product_id', 'cashier_id', 'date', 'time', 'quantity', 'price'];
}
