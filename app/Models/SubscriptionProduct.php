<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'subscription_id',
        'license',
        'product_id',
        'quantity',
        'created_by',
        'updated_by',
    ];

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription','subscription_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
