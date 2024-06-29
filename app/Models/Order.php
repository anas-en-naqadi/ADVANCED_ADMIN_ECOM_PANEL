<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'status','amount'];


    public function items()
    {
        return $this->hasMany(OrderItems::class)->with('product');
    }
    public function customer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
   
}
