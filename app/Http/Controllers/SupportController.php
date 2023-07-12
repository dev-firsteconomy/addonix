<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\Lead;
use App\Models\IndustryPerson;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage LeadSource'))
        {
            if(\Auth::user()->type == 'owner'){
                $supports = Support::where('created_by', \Auth::user()->creatorId())->get();
            }
            else{
                $supports = Support::where('created_by', \Auth::user()->id)->get();
            }
            return view('support.index', compact('supports'));
        }
        else
        {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Show the form for creating a new resource.
     *_name
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create LeadSource'))
        {
            $company = Lead::all()->pluck('company_name','id');
            $company->prepend('Select Company', '');
            return view('support.create',compact('company'));
        }
        else
        {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            if(\Auth::user()->can('Create LeadSource'))
            {
                $support                      = new Support();
                $support['ticket_type']            = $request->ticket_type;
                $support['ticket_source']      = $request->ticket_source;
                $support['support_mode']      = $request->support_mode ?: NULL;
                $support['sr_spr']   = $request->sr_spr ?: NULL;
                $support['sr_spr_no']    = $request->sr_spr_no ?: NULL;
                $support['lead_id']     = $request->lead_id ?: NULL;
                $support['poc_id']           = $request->poc_id ?: NULL;
                $support['mobile']      = $request->mobile ?: NULL;
                $support['email'] = $request->email ?: NULL;
                $support['product_id']    = $request->product_id ?: NULL;
                $support['subscription_end_date']    = $request->subscription_end_date ?: NULL;
                $support['contract_type']    = $request->contract_type ?: NULL;
                $support['contract_sub_type']    = $request->contract_sub_type ?: NULL;
                $support['problem_observed']    = $request->problem_observed ?: NULL;
                $support['solution_provided']    = $request->solution_provided ?: NULL;
                $support['status']    = $request->status ?: NULL;
                $support['assigned_to']    = $request->assigned_to ?: Auth::user()->id;
                $support['created_by']           = Auth::user()->id;
                $support->save(); 
    
                DB::commit();

                return redirect()->route('support.index')->with('success', 'Ticket Created Successfully');

            }
            else
            {
                return redirect()->back()->with('error', 'permission Denied');
            }
            
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Support $support
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Support $support
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        if(\Auth::user()->can('Edit LeadSource'))
        {
            $company = Lead::all()->pluck('company_name','id');
            $company->prepend('Select Company', '');
            $poc = IndustryPerson::where('id',$support->poc_id)->get()->pluck('name','id');
            $products = Product::where('id',$support->product_id)->get()->pluck('name','id');
            return view('support.edit', compact('support','company','poc','products'));
        }
        else
        {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\LeadSource $leadSource
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        DB::beginTransaction();
        try{
            if(\Auth::user()->can('Edit LeadSource'))
            {
            
                $support['ticket_type']            = $request->ticket_type;
                $support['ticket_source']      = $request->ticket_source;
                $support['support_mode']      = $request->support_mode ?: NULL;
                $support['sr_spr']   = $request->sr_spr ?: NULL;
                $support['sr_spr_no']    = $request->sr_spr_no ?: NULL;
                $support['lead_id']     = $request->lead_id ?: NULL;
                $support['poc_id']           = $request->poc_id ?: NULL;
                $support['mobile']      = $request->mobile ?: NULL;
                $support['email'] = $request->email ?: NULL;
                $support['product_id']    = $request->product_id ?: NULL;
                $support['subscription_end_date']    = $request->subscription_end_date ?: NULL;
                $support['contract_type']    = $request->contract_type ?: NULL;
                $support['contract_sub_type']    = $request->contract_sub_type ?: NULL;
                $support['problem_observed']    = $request->problem_observed ?: NULL;
                $support['solution_provided']    = $request->solution_provided ?: NULL;
                $support['status']    = $request->status ?: NULL;
                $support['assigned_to']    = $request->assigned_to ?: Auth::user()->id;
                $support['updated_by']           = Auth::user()->id;
                $support->save(); 

                DB::commit();
    
                return redirect()->route('support.index')->with('success', 'Ticket Has beed Updated Successfully!');
            }
            else
            {
                return redirect()->back()->with('error', 'permission Denied');
            }
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            return redirect('support')->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Support $support
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        if(\Auth::user()->can('Delete LeadSource'))
        {
            $support->delete();

            return redirect()->route('support.index')->with('success',  'Ticket Has been Deleted!');
        }
        else
        {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }
}
