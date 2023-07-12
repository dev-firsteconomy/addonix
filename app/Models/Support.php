<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'ticket_type',
        'ticket_source',
        'support_mode',
        'sr_spr',
        'sr_spr_no',
        'lead_id',
        'poc_id',
        'mobile',
        'email',
        'license',
        'product_id',
        'subscription_end_date',
        'contract_type',
        'contract_sub_type',
        'problem_observed',
        'solution_provided',
        'status',
        'assigned_to',
        'created_by',
        'updated_by'
    ];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }

    public function Owner()
    {
        return $this->belongsTo('App\Models\User','created_by','id');
    }

    public function poc()
    {
        return $this->belongsTo('App\Models\IndustryPerson','poc_id','id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

}
