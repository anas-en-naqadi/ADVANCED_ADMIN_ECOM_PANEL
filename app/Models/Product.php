<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = ['product_name','description','price','quantity','category_id','image','user_id','discount'];

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(ProductImages::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }


}
