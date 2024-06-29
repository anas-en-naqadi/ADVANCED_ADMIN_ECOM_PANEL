<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory;

    protected $table="blacklist";
    protected $fillable = ['user_id','reason','name'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
