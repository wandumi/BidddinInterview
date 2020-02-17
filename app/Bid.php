<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'email','price','product_id'
    ];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    // protected $hidden = [
    //     'user_id', 'id','product_id'
    // ];

}
