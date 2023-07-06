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
        'interaction_activity_type',
        'interaction_subject',
        'interaction_status',
        'interaction_date',
        'interaction_feedback',
        'interaction_followup_date',
        'company_name',
        'demo_date',
        'contact_person',
        'product_id',
        'demo_status',
        'oft_unique_id',
        'created_by',
        'assign_user_id'

    ];
    
    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }
}
