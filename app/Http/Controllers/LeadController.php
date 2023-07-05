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
use App\Models\LeadQuotation;
use App\Models\Stream;
use App\Models\Task;
use App\Models\Utility;
use App\Models\User;
use App\Models\Product;
use App\Models\Opportunities;
use App\Models\OpportunitiesProduct;
use App\Models\UserDefualtView;
use App\Models\IndustryPerson;
use App\Models\lead_interaction;
use App\Models\IndustryProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\ApprovalMail;
use App\Mail\SendQuotationMail;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (\Auth::user()->can('Manage Lead')) 
            {
                if(\Auth::user()->type == 'owner'){
                // $leads = Lead::where('created_by', \Auth::user()->creatorId())->get();
                $leads = Lead::where('type', 'Lead')->get();
                $defualtView         = new UserDefualtView();
                $defualtView->route  = \Request::route()->getName();
                $defualtView->module = 'lead';
                $defualtView->view   = 'list';
                User::userDefualtView($defualtView);
                }
                else{
                $leads = Lead::where('user_id', \Auth::user()->id)->where('type', 'Lead')->get();
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
    public function create(Request $request)
    {

        if (\Auth::user()->can('Create Lead')) 
        {
            $user       = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
            $user->prepend('Select Owner', '');
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
            $account->prepend('--', '');
            $products    = Product::get()->pluck('name', 'id');
            // $products->prepend('Select Product', '');
            $activities   = AccountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $activities->prepend('Select Type', 0);
            $status     = Lead::$status;

            return view('lead.create', compact('status', 'leadsource','products', 'user', 'account', 'type', 'industry', 'activities','industryVertical', 'campaign'));
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
        DB::beginTransaction();
        try{
            if(Auth::user()->can('Create Lead'))
            {
                $validator = \Validator::make($request->all(),
                    [
                        'company_name' => 'required|unique:leads|max:120',
                        'email' => 'required|email|unique:leads',
                        'phone' => 'required|integer|max:9999999999|unique:leads',
                        'poc_name.*' => 'required|string',
                        'poc_email.*' => 'required|email',
                        'poc_contact_number.*' => 'required|integer|max:9999999999',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $lead                      = new Lead();
                $lead['source']            = $request->source;
                $lead['company_name']      = $request->company_name;
                $lead['parent_company_name']      = $request->parent_company_name ? $request->parent_company_name : NULL;
                $lead['lead_address']   = $request->lead_address ? $request->lead_address : NULL;
                $lead['phone']    = $request->phone ? $request->phone : NULL;
                $lead['email']     = $request->email ? $request->email : NULL;
                $lead['website']           = $request->website ? $request->website : NULL;
                $lead['existing_customer']      = $request->existing_customer ? $request->existing_customer : NULL;
                $lead['type'] = $request->type ? $request->type : 'Lead';
                $lead['met_or_spoke']    = $request->met_or_spoke ? $request->met_or_spoke : NULL;
                $lead['is_mnc']    = $request->is_mnc ? $request->is_mnc : NULL;
                $lead['industry_vertical']    = $request->industry_vertical ? $request->industry_vertical : NULL;
                $lead['create_date']    = $request->create_date ? $request->create_date : NULL;
                $lead['estimated_close_date']    = $request->estimated_close_date ? $request->estimated_close_date : NULL;
                $lead['created_by']           = Auth::user()->id;
                $lead->save();   
                
                if(!empty($request->poc_name)){
                    foreach($request->poc_name as $k=>$item)
                    {
                        if(!empty($request->poc_name))
                        {
                            IndustryPerson::create([
                                'lead_id'=> $lead->id,
                                'name'=>$request->poc_name[$k],
                                'designation'=>$request->poc_designation[$k],
                                'contact_number'=>$request->poc_contact_number[$k],
                                'email_id'=>$request->poc_email_id[$k]
                            ]);  
                        }
                    }
                }

                DB::commit();
                    
                return redirect('lead')->with('success', __('Lead Successfully Created.'));
            } 
            else 
            {
                return redirect('lead')->with('error', 'permission Denied');
            }

        }catch(\Exception $e){
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
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
        if (\Auth::user()->can('Show Lead')) {

            $leadProducts=IndustryProduct::where('lead_id',$lead->id)->get();
            $leadPoc=IndustryPerson::where('lead_id',$lead->id)->get();
            $lead_interaction=lead_interaction::where('lead_id',$lead->id)->get();
            return view('lead.view', compact('lead','leadProducts','leadPoc','lead_interaction'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
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
            $user = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
            $user->prepend('Select Owner', '');
            $previous = Lead::where('id', '<', $lead->id)->max('id');
            $next = Lead::where('id', '>', $lead->id)->min('id');
            $products    = Product::get()->pluck('name', 'id');
            $selectedProducts = IndustryProduct::where('lead_id',$lead->id)->get()->pluck('product_id');
        
            return view('lead.edit', compact('lead','previous','next','products','selectedProducts','user'));
        } 
        else 
        {
            return redirect('lead')->with('error', 'permission Denied');
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
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Edit Lead')) 
            {           
                // dd($request->all(),"1asdf");
                $validator = \Validator::make($request->all(),
                    [
                        'company_name' => 'required|max:120|unique:leads,company_name,'.$lead->id,
                        'email' => 'required|email|unique:leads,email,'.$lead->id,
                        'phone' => 'required|integer|max:9999999999|unique:leads,phone,'.$lead->id,
                        'poc_name.*' => 'required|string',
                        'designation.*' => 'required',
                        'poc_email.*' => 'required|email',
                        'poc_contact_number.*' => 'required|integer|max:9999999999',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $update['source']            = $request->source;
                $update['company_name']      = $request->company_name;
                $update['parent_company_name']      = $request->parent_company_name;
                $update['lead_address']   = $request->lead_address;
                $update['phone']    = $request->phone;
                $update['email']     = $request->email;
                $update['website']           = $request->website;
                $update['existing_customer']      = $request->existing_customer;
                $update['type'] = $request->type ? $request->type : 'Lead';
                $update['met_or_spoke']    = $request->met_or_spoke;
                $update['is_mnc']    = $request->is_mnc;
                $update['industry_vertical']    = $request->industry_vertical;
                $update['create_date']    = $request->create_date;
                $update['estimated_close_date']    = $request->estimated_close_date;
                $update['created_by']           = Auth::user()->id;
    
                $leadUpdated =  Lead::where('id',$lead->id)->update($update);

                // old person Details 
                $oldIds = IndustryPerson::where('lead_id',$lead->id)->pluck('id')->toArray();
                $newIds = $request->poc_id;
                $removedIds = array_diff($oldIds,$newIds);
                // old person Details 

                // delete removeed person first
                if(!empty($removedIds && $removedIds > 0)){
                    foreach($removedIds as $rid){
                        $industryPersonData = IndustryPerson::find($rid);
                        $industryPersonData->delete();
                    }
                }
                // delete removeed person first
                if(!empty($request->poc_name)){
                    foreach ($request->poc_name as $k => $item) 
                    {
                        // check in orderDetails db by id
                        $personAlreadyExist = IndustryPerson::find($request->poc_id[$k]);
                        // check in orderDetails db by id 
                        if($personAlreadyExist)
                        {                        
                            $personAlreadyExist->update([
                                'name' => $request->poc_name[$k],
                                'designation' => $request->poc_designation[$k],
                                'contact_number' => $request->poc_contact_number[$k],
                                'email_id' => $request->poc_email_id[$k]
                            ]);
                        }else{
                            IndustryPerson::create([
                                'lead_id'=> $lead->id,
                                'name'=>$request->poc_name[$k],
                                'designation'=>$request->poc_designation[$k],
                                'contact_number'=>$request->poc_contact_number[$k],
                                'email_id'=>$request->poc_email_id[$k]
                            ]);  
                        }
                        
                    }
                }

                // old product Details 
                $p_oldIds = IndustryProduct::where('lead_id',$lead->id)->pluck('id')->toArray();
                $p_newIds = $request->poc_id;
                $p_removedIds = array_diff($p_oldIds,$p_newIds);
                // old product Details 
 
                 // delete removeed person first
                 if(!empty($p_removedIds && $p_removedIds > 0)){
                     foreach($p_removedIds as $rid){
                         $IndustryProductData = IndustryProduct::find($rid);
                         $IndustryProductData->delete();
                     }
                 }
                 // delete removeed person first
    
                if(isset($request->product_name)){
                    foreach($request->product_name as $k=>$productId)
                    {
                        if(!empty($request->product_name))
                        {
                            $productExistingRecord = IndustryProduct::where('product_id', $productId)->where('lead_id',$lead->id)->first();
                            if($productExistingRecord)
                            {  
                                $productExistingRecord->update([
                                    'product_id'=>$productId,
                                ]);
                            }else{
                                IndustryProduct::create([
                                    'lead_id'=> $lead->id,
                                    'product_id'=>$productId,
                                ]);
                            }
                        }
                    }
                }
    
                DB::commit();

                return redirect('lead')->with('success', __('Lead Successfully Updated.'));
            } else {
                return redirect('lead')->with('error', 'permission Denied');
            }
        }catch(\Exception $e){
            // dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
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

            return redirect('lead')->with('success', __('Lead Successfully Deleted.'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
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
            return redirect('lead')->with('error', __('Permission denied.'));
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

                return redirect('lead')->with('error', $messages->first());
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

            return redirect('lead')->with('success', __('Lead successfully converted.'));
        } else {
            return redirect('lead')->with('error', __('Permission denied.'));
        }
    }

    public function leadSearch(Request $request)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $oldestDate = Lead::orderBy('created_at', 'ASC')->value('created_at');

        $fromDate = !empty($request->fromDate) ? $request->fromDate : null;
        $toDate = !empty($request->toDate) ? $request->toDate : null;
        $leadType = !empty($request->leadType) ? $request->leadType : null;

        $leads = Lead::query();

        if ($leadType) {
            $leads->where('type', $leadType);
        }

        if (isset($fromDate) && isset($toDate))
        {   
            $leads->whereBetween('created_at', [$fromDate, $toDate]);
        }

        $leads = $leads->orderBy('id', 'DESC')->get();

        return view('lead.index', compact('leads'));
       
    }

    public function leadTab(Request $request)
    {
        $leadType = !empty($request->type) ? $request->type : 'Lead';

        $leads = Lead::query();

        if ($leadType) {
            $leads->where('type', $leadType);
        }

        $leads = $leads->orderBy('id', 'DESC')->get();

        return view('lead.index', compact('leads'));
       
    }

    public function sendApprovalEmail(Request $request)
    {
        try{
            $lead = Lead::find($request->id);
            $leadProducts=IndustryProduct::where('lead_id',$lead->id)->get();
            $leadPoc=IndustryPerson::where('lead_id',$lead->id)->get();
            $lead_interaction=lead_interaction::where('lead_id',$lead->id)->get();

            // $mail =  Mail::to('hasnain@firsteconomy.com')->send(new ApprovalMail($lead,$leadProducts,$leadPoc,$lead_interaction));
            
            // $lead->mail_sent = 1;
            // $lead->save();

            return view('lead.approvalMail', compact('lead'));

            // return redirect('lead')->with('success', 'Mail Sent Successfully.');

        }catch(\Exception $e){
            return redirect('lead')->with('error', 'Something Went Wrong');
        }
    }

    public function addInteration(Request $request)
    {
        $lead=Lead::where('id',$request->id)->first();
        $products= Product::pluck('name','id');
        $products->prepend('Select Product', '');
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.addInteration', compact('lead','products'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }
    
    public function submitInteraction(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Show Lead')) {
                lead_interaction::create([
                    'lead_id'=> (int)$request->lead_id,
                    'interaction_activity_type'=>$request->interaction_activity_type ? $request->interaction_activity_type : NULL,
                    'interaction_subject'=>$request->interaction_subject ? $request->interaction_subject : NULL,
                    'interaction_status'=>$request->interaction_status ? $request->interaction_status : NULL,
                    'interaction_date'=>$request->interaction_date ? $request->interaction_date : NULL,
                    'interaction_feedback'=>$request->interaction_feedback ? $request->interaction_feedback : NULL,
                    'interaction_followup_date'=>$request->interaction_followup_date,
                    'company_name'=>$request->company_name ? $request->company_name : NULL,
                    'demo_date'=>$request->demo_date ? $request->demo_date : NULL,
                    'contact_person'=>$request->contact_person ? $request->contact_person : NULL,
                    'product_id'=>$request->product_id ? $request->product_id : NULL,
                    'demo_status'=>$request->demo_status ? $request->demo_status : NULL,
                    'oft_unique_id'=>$request->oft_unique_id ? $request->oft_unique_id : NULL,
                    'created_by'=>$request->created_by ? $request->created_by : NULL,
                    'assign_user_id'=>$request->assign_user_id ? $request->assign_user_id : NULL,
                ]); 
                DB::commit();
                return redirect('lead')->with('success', __('Interaction Added Successfully.'));
            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            // dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }

    public function addPoc(Request $request)
    {
        $lead=Lead::where('id',$request->id)->first();
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.addPoc', compact('lead'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }

    public function submitAddPoc(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Show Lead')) {
                IndustryPerson::create([
                    'lead_id'=> (int)$request->lead_id,
                    'name'=>$request->name,
                    'email_id'=>$request->email_id,
                    'contact_number'=>$request->contact_number,
                    'designation'=>$request->designation,
                ]); 
                DB::commit();
                return redirect('lead')->with('success', __('POC Added Successfully.'));
            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }

    public function editPoc(Request $request)
    {
        $poc = IndustryPerson::find($request->id);
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.editPoc', compact('poc'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }

    public function submitEditPoc(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Show Lead')) {

                $pocData['name']            = $request->name;
                $pocData['email_id']      = $request->email_id;
                $pocData['contact_number']      = $request->contact_number;
                $pocData['designation']   = $request->designation;

                $pocUpdated =  IndustryPerson::where('id',$request->poc_id)->update($pocData);

                DB::commit();
                return redirect('lead')->with('success', __('POC Updated Successfully.'));
            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }

    public function addQuotation(Request $request)
    {
        $lead=Lead::where('id',$request->id)->first();
        $products= Product::pluck('name','id');
        $products->prepend('Select Product', '');
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.addQuotation', compact('lead','products'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }
    
    public function sendQuotation(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Create Lead')) {
                LeadQuotation::create([
                    'lead_id'=> (int)$request->lead_id,
                    'product_id'=>$request->product_id,
                    // 'quantity'=>$request->quantity,
                    'price'=>$request->price,
                    'discount'=>$request->discount,
                    'final_amount'=>$request->final_amount,
                ]); 

                $quotationData['quantity'] = $request->quantity;
                $quotationData['discount'] = $request->discount;
                $quotationData['final_amount'] = $request->final_amount;

                $lead = Lead::where('id',$request->lead_id)->first();
                $product = Product::where('id',$request->product_id)->first();
                // $ccEmails = IndustryPerson::where('lead_id',$request->lead_id)->pluck('email_id')->toArray();
                // $lead_quotations = LeadQuotation::where('lead_id',$request->lead_id)->get();

                // WORD CODE
                // $pdf = \PDF::loadView('lead.download_quotation',compact('lead','quotationData','product'));
                // return $pdf->download($lead->company_name."-".date('Y-m-d H:i:s').".pdf");
                // WORD CODE


                // WORD CODE
                $phpWord = new \PhpOffice\PhpWord\PhpWord();

                $section = $phpWord->addSection();

                // Defining the HTML content
                $htmlContent = view('lead.download_quotation',compact('lead','quotationData','product'))->render();

                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent);

                // Save file
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $file = $lead->company_name.'quotation.docx';
                $path = public_path($file);
                $objWriter->save($path);

                // Download the file
                return response()->download($file)->deleteFileAfterSend(true);
                // WORD CODE
                
                // return view('lead.download_quotation',compact('lead','quotationData','product'));


                // $mail =  Mail::to(@$lead->email)->cc($ccEmails)->send(new SendQuotationMail($lead,$lead_quotations));

                DB::commit();

                return redirect('lead')->with('success', __('Quotation Sent Successfully.'));
            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }

    // create an opportunity
    public function createOpportunityModal(Request $request)
    {
        $lead=Lead::where('id',$request->id)->first();
        $poc= IndustryPerson::where('lead_id',$request->id)->get()->pluck('name','id');
        $poc->prepend('Select Point of Contact', '');
        $products= Product::pluck('name','id');
        $products->prepend('Select Product', '');
        $user = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
        $user->prepend('Select Owner', '');
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.opportunity', compact('lead','products','user','poc'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }
    
    public function createOpportunity(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Create Lead')) {

                $lead = Lead::where('id',$request->lead_id)->first();
                $product = Product::where('id',$request->product_id)->first();

                $opportunity = Opportunities::create([
                    'lead_id'=> (int)$request->lead_id,
                    'date_created'=>$request->date_created ? $request->date_created : NULL,
                    'poc_id'=>$request->poc_id ? $request->poc_id : NULL,
                    'sales_stage'=>$request->sales_stage ? $request->sales_stage : NULL,
                    'close_date'=>$request->close_date ? $request->close_date : NULL,
                    'cbi_identified'=>$request->cbi_identified ? $request->cbi_identified : NULL,
                    'assigned_to'=>$request->assigned_to ? $request->assigned_to : NULL,
                    'status'=>$request->status ? $request->status : NULL,
                    'feedback'=>$request->feedback ? $request->feedback : NULL,
                    'product_type'=>$request->product_type ? $request->product_type : NULL,
                    'created_by'=>Auth::user()->id,
                ]); 

                if($opportunity){
                    if(isset($request->product_id) && isset($request->quantity) && isset($request->price)  && isset($request->discount)){
                        foreach($request->product_id as $k=>$item)
                        {   
                            if($request->product_id[$k] && $request->quantity[$k] && $request->price[$k])
                            {
                                OpportunitiesProduct::create([
                                    'opportunity_id'=> $opportunity->id,
                                    'product_id'=>$request->product_id[$k],
                                    'quantity'=>$request->quantity[$k],
                                    'price'=>$request->price[$k],
                                    'discount'=>$request->discount[$k],
                                    'created_by'=>Auth::user()->id,
                                ]);  
                            }
                        }
                    }
                }

                DB::commit();

                return redirect('lead')->with('success', __('Opportunity Created Successfully.'));
            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }
    // create an opportunity
    
    // edit an opportunity
    public function editOpportunityModal(Request $request)
    {
        $opportunity = Opportunities::where('id',$request->id)->first();
        $poc= $opportunity->lead->industryPerson->pluck('name','id');
        $poc->prepend('Select Point of Contact', '');
        $products= Product::pluck('name','id');
        $products->prepend('Select Product', '');
        $user = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'name');
        $user->prepend('Select Owner', '');
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.editOpportunity', compact('products','user','poc','opportunity'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }
    
    public function editOpportunity(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Create Lead')) {
                $opportunity = Opportunities::find($request->opportunity_id);
                $opportunity->date_created = $request->date_created ?: null;
                $opportunity->poc_id = $request->poc_id ?: null;
                $opportunity->sales_stage = $request->sales_stage ?: null;
                $opportunity->close_date = $request->close_date ?: null;
                $opportunity->cbi_identified = $request->cbi_identified ?: null;
                $opportunity->assigned_to = $request->assigned_to ?: null;
                $opportunity->status = $request->status ?: null;
                $opportunity->feedback = $request->feedback ?: null;
                $opportunity->product_type = $request->product_type ?: null;
                $opportunity->updated_by = Auth::user()->id;
                $opportunity->save();

                if($request->product_type === 'Network')
                    if($opportunity){
                        if(isset($request->product_id) && isset($request->quantity) && isset($request->price)  && isset($request->discount)){
                            // old opportunities Details 
                            $oldIds = OpportunitiesProduct::where('opportunity_id',$opportunity->id)->pluck('id')->toArray();
                            $newIds = $request->op_id;
                            $removedIds = array_diff($oldIds,$newIds);
                            // old opportunities Details 

                            // delete removed opportunities first
                            if(!empty($removedIds && $removedIds > 0)){
                                foreach($removedIds as $rid){
                                    $opData = OpportunitiesProduct::find($rid);
                                    $opData->delete();
                                }
                            }
                            // delete removeed person first

                            if(!empty($request->product_id)){
                                foreach ($request->product_id as $k => $item) 
                                {
                                    // check in orderDetails db by id
                                    $opAlreadyExist = OpportunitiesProduct::find($request->op_id[$k]);
                                    // check in orderDetails db by id 
                                    if($opAlreadyExist)
                                    {   
                                        $opAlreadyExist->update([
                                            'product_id' => $request->product_id[$k],
                                            'quantity' => $request->quantity[$k],
                                            'price' => $request->price[$k],
                                            'discount' => $request->discount[$k],
                                            'updated_by' => Auth::user()->id,
                                        ]);
                                    }else{
                                        OpportunitiesProduct::create([
                                            'opportunity_id'=> $opportunity->id,
                                            'product_id'=> $request->product_id[$k],
                                            'quantity'=>$request->quantity[$k],
                                            'price'=>$request->price[$k],
                                            'discount'=>$request->discount[$k],
                                            'updated_by'=>Auth::user()->id
                                        ]);  
                                    }
                                    
                                }
                            }

                        }

                        DB::commit();

                        return redirect('lead')->with('success', __('Opportunity Updated Successfully.'));
                    }

                else
                {
                    // dd('down',$opportunity,$request->all());
                    $opUpdate['product_id'] = $request->product_id[0] ? $request->product_id[0] : NULL;
                    $opUpdate['quantity'] = $request->quantity[0] ? $request->quantity[0] : NULL;
                    $opUpdate['price'] = $request->price[0] ? $request->price[0] : NULL;
                    $opUpdate['discount'] = $request->discount[0] ? $request->discount[0] : NULL;
                    $opUpdate['updated_by'] = Auth::user()->id;

                    $op_Data = OpportunitiesProduct::where('id',$request->op_id[0])->update($opUpdate);

                    DB::commit();

                    return redirect('lead')->with('success', __('Opportunity Created Successfully.'));
                }
            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }
    // edit an opportunity

    public function addPerforma(Request $request)
    {
        $lead=Lead::where('id',$request->id)->first();
        $products= Product::pluck('name','id');
        $products->prepend('Select Product', '');
        if (\Auth::user()->can('Show Lead')) {
            return view('lead.addPerforma', compact('lead','products'));
        } else {
            return redirect('lead')->with('error', 'permission Denied');
        }
    }

    public function sendPerforma(Request $request)
    {
        DB::beginTransaction();
        try{
            if (\Auth::user()->can('Create Lead')) {
                LeadQuotation::create([
                    'lead_id'=> (int)$request->lead_id,
                    'invoice_no'=>$request->invoice_no,
                    'date'=>$request->date,
                    'buyers_order_no'=>$request->buyers_order_no,
                    'buyer'=>$request->buyer,
                    'address'=>$request->address,
                    'to_name'=>$request->to_name,
                    'gst_no'=>$request->gst_no,
                    'product_id'=>$request->product_id,
                    'quantity'=>$request->quantity,
                    'price'=>$request->price,
                    'discount'=>$request->discount,
                    'final_amount'=>$request->final_amount,
                ]); 

                $performaData['invoice_no'] = $request->invoice_no;
                $performaData['date'] = $request->date;
                $performaData['buyers_order_no'] = $request->buyers_order_no;
                $performaData['buyer'] = $request->buyer;
                $performaData['address'] = $request->address;
                $performaData['to_name'] = $request->to_name;
                $performaData['gst_no'] = $request->gst_no;
                $performaData['quantity'] = $request->quantity;
                $performaData['discount'] = $request->discount;
                $performaData['final_amount'] = $request->final_amount;

                $lead = Lead::where('id',$request->lead_id)->first();
                $product = Product::where('id',$request->product_id)->first();


                // WORD CODE
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                
                $section = $phpWord->addSection();

                // Defining the HTML content
                $htmlContent = view('lead.download_performa',compact('lead','performaData','product'))->render();

                \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent);

                // Save file
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $file = $lead->company_name.'performa.docx';
                $path = public_path($file);
                $objWriter->save($path);
                
                DB::commit();

                // Download the file
                return response()->download($file)->deleteFileAfterSend(true);
                // WORD CODE
                
                // return view('lead.download_performa',compact('lead','performaData','product'));

            } else {
                return redirect('lead')->with('error', 'Permission Denied');
            }
        }catch(\Exception $e){
            dd('error',$e);
            DB::rollback();
            return redirect('lead')->with('error', 'Something Went Wrong');
        }   
    }

    public function getProductPrice(Request $request)
    {
        $productId = $request->input('productId');
        $product = Product::find($productId);

        if ($product) {
            return response()->json(['price' => $product->price]);
        } else {
            return response()->json(['price' => null]);
        }
    }

    public function verifyHtml(Request $request)
    {
        $leadId = $request->input('leadId');
        $lead = Lead::find($leadId);

        if ($lead) {
            $html = "Company: " .$lead->company_name. "\r\n";  
            $html .= "Email: " .$lead->email. "\r\n";  
            $html .= "Phone: " .$lead->phone. "\r\n";  
            $html .= "Type: " .$lead->type. "\r\n";  

            return response()->json(['html' => urlencode($html)]);
        } else {
            return response()->json(['html' => null]);
        }
    }
    
    
    public function companySearch(Request $request)
    {
        $query = $request->get('term');

        $companies = Lead::where('company_name','LIKE','%'.$query.'%')->pluck('company_name');

            
        return response()->json($companies);
    }

}
