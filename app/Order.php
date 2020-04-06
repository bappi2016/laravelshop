<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    // Create a relationship between Order and User-One to one
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Create a relationship between OrderItem and Order- Many to many
    public function OrderItems(){
        return $this->hasMany(OrderItems::class);
    }

    // Create a One to many relationship between Order and order_items and Product
    public function products(){
        return $this->belongsToMany(Product::class,'order_items');
    }
}
