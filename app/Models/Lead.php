<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        // 'user_id',
        // 'name',
        // 'email',
        // 'phone',
        // 'website',
        // 'billing_address',
        // 'billing_city',
        // 'billing_state',
        // 'billing_country',
        // 'billing_postalcode',
        // 'shipping_address',
        // 'shipping_city',
        // 'shipping_state',
        // 'shipping_country',
        // 'shipping_postalcode',
        // 'type',
        // 'industry',
        // 'is_converted',
        // 'created_by',
        // 'description',
        'source',
        'company_name',
        'parent_company_name',
        'lead_address',
        'phone',
        'email',
        'website',
        'existing_customer',
        'type',
        'cbi_identified',
        'met_or_spoke',
        'is_mnc',
        'industry_vertical',
        'sales_stage',
        'create_date',
        'estimated_close_date',
        'assign_user_id',
        'created_by',
    ];

    protected $appends = [
        'status_name',
        'account_name',
        'source_name',
        'campaign_name',
    ];

    public static $status = [
        'New',
        'Assigned',
        'In Process',
        'Converted',
        'Recycled',
        'Dead',
    ];

    public function assign_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function accountIndustry()
    {
        return $this->hasOne('App\Models\AccountIndustry', 'id', 'industry');
    }

    public function LeadSource()
    {
        return $this->hasOne('App\Models\LeadSource', 'id', 'source');
    }

    public function campaigns()
    {
        return $this->hasOne('App\Models\Campaign', 'id', 'campaign');
    }

    public function accounts()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account');
    }

    public static function leads($id)
    {
        return Lead::where('status', '=', $id)->get();
    }

    public function getStatusNameAttribute()
    {
        // $status = Lead::$status[$this->status];

        // return $this->attributes['status_name'] = $status;
        return null;
    }

    public function getAccountNameAttribute()
    {
        // $account = Lead::find($this->account);


        // return $this->attributes['account_name'] = !empty($account) ? $account->name : '';
        return null;
    }

    public function getCampaignNameAttribute()
    {
        // $campaign = Lead::find($this->campaign);

        // return $this->attributes['campaign_name'] = !empty($campaign) ? $campaign->name : '';
        return null;
    }

    public function getSourceNameAttribute()
    {
        // $lead_source = Lead::find($this->source);

        // return $this->attributes['source_name'] = !empty($lead_source) ? $lead_source->name : '';
        return null;
    }

    public function stages()
    {
        return $this->hasOne('App\Models\TaskStage', 'id', 'stage');
    }

    public function industryPerson()
    {
        return $this->hasMany('App\Models\IndustryPerson','lead_id','id');
    }
    
    public function industryProduct()
    {
        return $this->hasMany('App\Models\IndustryProduct','lead_id','id');
    }

    public function lead_interaction()
    {
        return $this->hasMany('App\Models\lead_interaction','lead_id','id');
    }

    public function leadQuotation()
    {
        return $this->hasMany('App\Models\LeadQuotation','lead_id','id');
    }

}
