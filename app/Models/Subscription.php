<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'lead_id',
        'opportunity_id',
        'product_type',
        'subscription_start_date',
        'subscription_end_date',
        'contract_value',
        'contract_terms',
        'contract_sub_type',
        'parent',
        'is_renew',
        'created_by'
    ];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }

    public function Owner()
    {
        return $this->belongsTo('App\Models\User','created_by','id');
    }

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunities','opportunity_id','id');
    }

    public function subscriptionProducts()
    {
        return $this->hasMany('App\Models\SubscriptionProduct','subscription_id','id');
    }
}
