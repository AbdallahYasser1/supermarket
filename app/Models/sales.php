<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;

    public $table = 'sales';
    protected $fillable = ['product_id', 'quantity', 'price'];
    protected $appends = ['total'];
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
