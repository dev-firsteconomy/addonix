<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountIndustry;
use App\Models\AccountType;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Stream;
use App\Models\Task;
use App\Models\Utility;
use App\Models\User;
use App\Models\UserDefualtView;
use App\Models\IndustryPerson;
use App\Models\IndustryProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (\Auth::user()->can('Manage Lead')) {
                if(\Auth::user()->type == 'owner'){
                // $leads = Lead::where('created_by', \Auth::user()->creatorId())->get();
                $leads = Lead::get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'lead';
                $defualtView->view   = 'list';
                User::userDefualtView($defualtView);
                }
                else{
                    $leads = Lead::where('user_id', \Auth::user()->id)->get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'lead';
                $defualtView->view   = 'list';
                }
                return view('lead.index', compact('leads'));
            } else {
                return redirect()->back()->with('error', 'permission Denied');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $id,Request $request)
    {
        
        if (\Auth::user()->can('Create Lead')) 
        {
            $user       = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $user->prepend('--', 0);
            $leadsource = LeadSource::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $campaign   = Campaign::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $campaign->prepend('--', 0);
            $industry   = AccountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $industry->prepend('Select Industry', 0);
            $type   = AccountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $type->prepend('Select Type', 0);
            $industryVertical   = AccountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $industryVertical->prepend('Select Industry Vertical', 0);
            $account    = Account::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $account->prepend('--', 0);
            $activities   = AccountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $activities->prepend('Select Type', 0);
            $status     = Lead::$status;

            return view('lead.create', compact('status', 'leadsource', 'user', 'account', 'type', 'industry', 'activities','industryVertical', 'campaign', 'type', 'id'));
        } else {
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
        // dd($request->all(),Auth::user()->id);
        if(Auth::user()->can('Create Lead'))
        {
            // dd($request->all());
            $lead                           = new Lead();
            $lead['user_id']                = Auth::user()->id;
            $lead['company_name']           = $request->company_name;
            $lead['lead_type_id']            = $request->lead_type_id;
            $lead['company_address']         = $request->company_address;
            $lead['company_mobile']          = $request->company_mobile;
            $lead['company_email']           = $request->company_email;
            $lead['website']            = $request->website;
            $lead['industry_vertical']       = $request->industry_vertical;
            $lead['assign_user_id']          = $request->assign_user_id;
            $lead['activities']          = $request->activities;
            $lead->save();   
            
            foreach($request->name as $k=>$item)
            {
                if(!empty($request->name))
                {
                    IndustryPerson::create([
                        'lead_id'=> $lead->id,
                        'name'=>$item,
                        'designation'=>$request->designation[$k],
                        'contact_number'=>$request->contact_number[$k],
                        'email_id'=>$request->email_id[$k]
                    ]);  
                }
            }

            foreach($request->product_name as $k=>$item)
            {
                if(!empty($request->product_name))
                {
                    IndustryProduct::create([
                        'lead_id'=> $lead->id,
                        'product_name'=>$item,
                        'serial_number'=>$request->serial_number[$k],
                        'sub_start_date'=>$request->sub_start_date[$k],
                        'sub_end_date'=>$request->sub_end_date[$k],
                        'price'=>$request->price[$k],
                        'sale_date'=>$request->sale_date[$k],
                        'created_by'=>$request->created_by[$k],
                    ]);
                }
            }

            return redirect()->back()->with('success', __('Lead Successfully Created.'));
        } 
        else 
        {
            return redirect()->back()->with('error', 'permission Denied');
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        // dd($lead);
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.view', compact('lead'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        
        if (Auth::user()->can('Edit Lead')) 
        {
            $lead = Lead::first();
            $previous = Lead::where('id', '<', $lead->id)->max('id');
            $next = Lead::where('id', '>', $lead->id)->min('id');
            return view('lead.edit', compact('lead','previous','next'));
        } 
        else 
        {
            return redirect()->back()->with('error', 'permission Denied');
        }

        // dd($lead);
        // if (\Auth::user()->can('Edit Lead')) {
        //     $status   = Lead::$status;
        //     $source   = LeadSource::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //     $user     = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //     $user->prepend('--', 0);
        //     $account  = Account::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //     $account->prepend('--', 0);
        //     $industry = AccountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //     $parent   = 'lead';
        //     $tasks    = Task::where('parent', $parent)->where('parent_id', $lead->id)->get();
        //     $log_type = 'lead comment';
        //     $streams  = Stream::where('log_type', $log_type)->get();
        //     $campaign = Campaign::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //     $campaign->prepend('--', 0);
            // get previous user id
            // $previous = Lead::where('id', '<', $lead->id)->max('id');
            // get next user id
            // $next = Lead::where('id', '>', $lead->id)->min('id');


        //     return view('lead.edit', compact('lead', 'account', 'user', 'source', 'industry', 'status', 'tasks', 'streams', 'campaign', 'previous', 'next'));
        // } else {
        //     return redirect()->back()->with('error', 'permission Denied');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        if (\Auth::user()->can('Edit Lead')) 
        {           
            $update['user_id']                 = Auth::user()->id;
            $update['company_name']            = $request->company_name;
            $update['lead_type_id']            = $request->lead_type_id;
            $update['company_address']         = $request->company_address;
            $update['company_mobile']          = $request->company_mobile;
            $update['company_email']           = $request->company_email;
            $update['website']                 = $request->website;
            $update['industry_vertical']       = $request->industry_vertical;
            $update['assign_user_id']          = $request->assign_user_id;
            $update['activities']              = $request->activities;

            Lead::where('id',$lead->id)->update($update);
            

            foreach ($request->name as $k => $item) 
            {
                if (!empty($item)) 
                {
                    $existingRecord = IndustryPerson::where('name', $item)->where('lead_id',$lead->id)->first();
                    if($existingRecord)
                    {                        
                        $existingRecord->update([
                            'lead_id' => $lead->id,
                            'name' => $item,
                            'designation' => $request->designation[$k],
                            'contact_number' => $request->contact_number[$k],
                            'email_id' => $request->email_id[$k]
                        ]);
                    }
                }
            }

            foreach($request->product_name as $k=>$item)
            {
                if(!empty($request->product_name))
                {
                    $productExistingRecord = IndustryProduct::where('product_name', $item)->where('lead_id',$lead->id)->first();
                    if($existingRecord)
                    {  
                        $productExistingRecord->update([
                            'lead_id'=> $lead->id,
                            'product_name'=>$item,
                            'serial_number'=>$request->serial_number[$k],
                            'sub_start_date'=>$request->sub_start_date[$k],
                            'sub_end_date'=>$request->sub_end_date[$k],
                            'price'=>$request->price[$k],
                            'sale_date'=>$request->sale_date[$k],
                            'created_by'=>$request->created_by[$k],
                        ]);
                    }
                }
            }

            return redirect()->back()->with('message', __('Lead Successfully Updated.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        if (\Auth::user()->can('Delete Lead')) {
            $lead->delete();

            return redirect()->back()->with('success', __('Lead Successfully Deleted.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function grid()
    {
        $leads   = Lead::where('created_by', '=', \Auth::user()->creatorId())->get();
        $statuss = Lead::where('created_by', '=', \Auth::user()->creatorId())->get();

        // if($leads->isNotEmpty())
        // {
        //     $users = user::where('id', $leads[0]->user_id)->get();
        // }

        $defualtView         = new UserDefualtView();
        $defualtView->route  = \Request::route()->getName();
        $defualtView->module = 'lead';
        $defualtView->view   = 'kanban';
        User::userDefualtView($defualtView);
        // if($leads->isEmpty())
        // {
        //     return view('lead.grid', compact( 'statuss'));
        // }
        // else
        // {
        //      return view('lead.grid', compact('leads', 'statuss','users'));
        // }
        return view('lead.grid', compact('leads', 'statuss'));
    }

    public function changeorder(Request $request)
    {
        $post   = $request->all();
        $lead   = Lead::find($post['lead_id']);
        $status = Lead::where('status', $post['status_id'])->get();


        if (!empty($status)) {
            $lead->status = $post['status_id'];
            $lead->save();
        }

        foreach ($post['order'] as $key => $item) {
            $order         = Lead::find($item);
            $order->status = $post['status_id'];
            $order->save();
        }
    }

    public function showConvertToAccount($id)
    {
        if (\Auth::user()->type == 'owner') {
            $lead        = Lead::findOrFail($id);
            $accountype  = accountType::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $industry    = accountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $user        = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $document_id = Document::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('lead.convert', compact('lead', 'accountype', 'industry', 'user', 'document_id'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function convertToAccount($id, Request $request)
    {
        if (\Auth::user()->type == 'owner') {
            $lead = Lead::findOrFail($id);
            $usr  = \Auth::user();

            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:accounts,email',
                    'shipping_postalcode' => 'required',
                    'lead_postalcode' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $account                        = new account();
            $account['user_id']             = $request->user;
            $account['document_id']         = $request->document_id;
            $account['name']                = $request->name;
            $account['email']               = $request->email;
            $account['phone']               = $request->phone;
            $account['website']             = $request->website;
            $account['billing_address']     = $request->lead_address;
            $account['billing_city']        = $request->lead_city;
            $account['billing_state']       = $request->lead_state;
            $account['billing_country']     = $request->lead_country;
            $account['billing_postalcode']  = $request->lead_postalcode;
            $account['shipping_address']    = $request->shipping_address;
            $account['shipping_city']       = $request->shipping_city;
            $account['shipping_state']      = $request->shipping_state;
            $account['shipping_country']    = $request->shipping_country;
            $account['shipping_postalcode'] = $request->shipping_postalcode;
            $account['type']                = $request->type;
            $account['industry']            = $request->industry;
            $account['description']         = $request->description;
            $account['created_by']          = \Auth::user()->creatorId();
            $account->save();
            // end create deal

            // Update is_converted field as deal_id
            $lead->is_converted = $account->id;
            $lead->save();

            return redirect()->back()->with('success', __('Lead successfully converted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
