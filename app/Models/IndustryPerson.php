<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryPerson extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected     $fillable = [
        'lead_id',
        'name',
        'designation',
        'contact_number',
        'email_id',
    ];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }
    
}
