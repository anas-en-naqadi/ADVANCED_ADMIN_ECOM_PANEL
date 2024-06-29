<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory, SoftDeletes;



    protected $fillable = ['user_id', 'address', 'city', 'state', 'country', 'postal_code'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
