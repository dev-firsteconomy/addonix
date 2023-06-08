<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadQuotation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected     $fillable = [
        'lead_id',
        'product_id',
        'price',
        'discount',
        'final_amount'
    ];
    
    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
