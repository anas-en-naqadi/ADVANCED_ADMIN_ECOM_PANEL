<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'invoice_id', 'product_id', 'quantity', 'total_amount'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
