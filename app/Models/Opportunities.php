<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunities extends Model
{
    protected $fillable = [
        'lead_id',
        'poc_id',
        'date_created',
        'product_type',
        'sales_stage',
        'close_date',
        'assigned_to',
        'status',
        'cbi_identified',
        'feedback',
        'created_by',
        'description',
    ];
    protected $appends  = [
        'assigned_to',
        'stage_name',
        'updated_by'
    ];

    public function assign_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function opportunity_products()
    {
        return $this->hasMany('App\Models\OpportunitiesProduct', 'opportunity_id', 'id');
    }

    public function accounts()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account');
    }

    public function campaign_ids()
    {
        return $this->hasOne('App\Models\Campaign', 'id', 'campaign_id');
    }

    public function leadsource()
    {
        return $this->hasOne('App\Models\LeadSource', 'id', 'lead_source');
    }

    public function contacts()
    {
        return $this->hasOne('App\Models\Contact', 'id', 'contact');
    }

    public function opportunities()
    {
        return $this->hasOne('App\Models\Document', 'id', 'opportunities');
    }

    public function getAccountNameAttribute()
    {
        $account = Opportunities::find($this->account);


        return $this->attributes['account_name'] = !empty($account) ? $account->name : '';
    }

    public function getContactNameAttribute()
    {
        $contact = Opportunities::find($this->contact);

        return $this->attributes['contact_name'] = !empty($contact) ? $contact->name : '';
    }

    public function getCampaignNameAttribute()
    {
        $campaign = Opportunities::find($this->campaign);

        return $this->attributes['campaign_name'] = !empty($campaign) ? $campaign->name : '';
    }

    public function getStageNameAttribute()
    {
        $stage = OpportunitiesStage::find($this->stage);

        return $this->attributes['stage_name'] = !empty($stage) ? $stage->name : '';
    }

    public function taskstages()
    {
        return $this->hasOne('App\Models\TaskStage', 'id', 'stage');
    }

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead','lead_id','id');
    }
}

