<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','sku', 'price', 'description','id'
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
