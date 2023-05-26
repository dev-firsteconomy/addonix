<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }
}
