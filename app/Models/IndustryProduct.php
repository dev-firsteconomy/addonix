<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected     $fillable = [
        'lead_id',
        'product_id'
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
