<div class="row">
    <div class="col-4">
        <b><label for="">Activity Type</label></b>
        <p>{{$interaction->interaction_activity_type}}</p>
    </div>
    <div class="col-4">
        <b><label for="">Subject</label></b>
        <p>{{$interaction->interaction_subject}}</p>
    </div>   
    <div class="col-4">
        <b><label for="">Status</label></b>
        <p>{{$interaction->interaction_status}}</p>
    </div>
    <div class="col-4">
        <b><label for="">Interaction Date</label></b>
        <p>{{$interaction->interaction_date}}</p>
    </div>
    <div class="col-4">
        <b><label for="">Feedback</label></b>
        <p>{{$interaction->interaction_feedback}}</p>
    </div>    
    <div class="col-4">
        <b><label for="">Follow Up Date</label></b>
        <p>{{$interaction->interaction_followup_date}}</p>
    </div>
    <!-- HIDDEN FIELDS -->
    @if(@$interaction->interaction_activity_type == 'Demo')
    <div class="col-4 demo">
        <b><label for="">Company Name</label></b>
        <p>{{$interaction->company_name}}</p>
    </div> 
    <div class="col-4 demo">
        <b><label for="">Demo Date</label></b>
        <p>{{$interaction->demo_date}}</p>
    </div>
    <div class="col-4 demo">
        <b><label for="">Point of Contact</label></b>
        <p>{{$interaction->contact_person}}</p>
    </div>
    <div class="col-4 demo">
        <b><label for="">Product</label></b>
        <p>{{$interaction->product_id}}</p>
    </div>
    <div class="col-4 demo">
        <b><label for="">Demo Status</label></b>
        <p>{{$interaction->demo_status}}</p>
    </div>
    <div class="col-4 demo">
        <b><label for="">OFT Unique ID</label></b>
        <p>{{$interaction->oft_unique_id}}</p>
    </div>  
    <div class="col-4 demo">
        <b><label for="">Assigned To</label></b>
        <p>{{$interaction->assign_user_id}}</p>
    </div> 
    @endif
    <!-- HIDDEN FIELDS -->
</div>
