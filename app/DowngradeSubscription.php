<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DowngradeSubscription extends Model
{
    use HasFactory;
    protected $table = 'downgrage_subscriptions';
    protected $fillable = [
        'user_id',
        'subscription_id',
        'subscription_frequency',
        'renewal_date',
        'sub_pro_id',
        'status'
    ];
}