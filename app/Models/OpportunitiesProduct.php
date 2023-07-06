<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpportunitiesProduct extends Model
{
    protected     $fillable = [
        'opportunity_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'created_by',
        'updated_by',
        ];

    public function opportunityOld($id)
    {
        return Opportunities::where('stage', '=', $id)->get();
    }

    public function opportunity()
    {
        return $this->belongsTo('App\Models\Opportunities','opportunity_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
