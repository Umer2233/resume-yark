<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionProduct extends Model
{
    use HasFactory;
    protected $table = "subscription_product_details";
    protected $fillable = ['subscription_id', 'price_id', 'type', 'status'];


    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class, 'id','subscription_id');
    }

}