<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable  = ['product_id','image_path'];

    public function product(){
        return $this->belongTo(Product::class);
    }
}
