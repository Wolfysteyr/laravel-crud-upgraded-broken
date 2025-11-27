<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'quantity',
        'description',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    function decreaseQuantity(){
        if ($this->quantity - 1 >= 0){
            return true;
        } else {
            return false;
        }
    }
    function increaseQuantity(){
        return true;
    }

}
