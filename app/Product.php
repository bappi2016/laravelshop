<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // $guarded = [], that means we don't need to type all the table fields
    protected $guarded = [];
}
