<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead_interaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected     $fillable = [
        'lead_id',
        'interaction_date',
        'interaction_activity_type',
        'interaction_feedback'
    ];
    
    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }
}
