{{Form::model($coupon, array('route' => array('coupon.update', $coupon->id), 'method' => 'PUT')) }}
<div class="row">
    <div class="form-group col-md-12">
        <label for="name" class="col-form-label">{{__('Name')}}</label>
        <input type="text" name="name" class="form-control" required value="{{$coupon->name}}">
       
    </div>
    <div class="form-group col-md-6">
        <label for="discount" class="col-form-label">{{__('Discount')}}</label>
        <input type="number" name="discount" class="form-control" required step="0.01" value="{{$coupon->discount}}">
        <span class="small">{{__('Note: Discount in Percentage')}}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="limit" class="col-form-label">{{__('Limit')}}</label>
        <input type="number" name="limit" class="form-control" required value="{{$coupon->limit}}">
    </div>
    <div class="form-group col-md-12">
        <div class="row">
                <div class="col-md-10">
                    <input class="form-control" name="code" type="text" id="auto-code" value="{{$coupon->code}}">
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn btn-primary" id="code-generate"><i class="ti ti-history"></i></a>
                    {{-- <a href="#" class="btn btn-xs btn-icon-only width-auto" id="code-generate"><i class="fas fa-history"></i> {{__('Generate')}}</a> --}}
                </div>
            </div>
    </div>
    <div class="modal-footer col-md-12">
        {{Form::submit(__('Update'),array('class'=>'btn btn-primary '))}}
    </div>
</div>
{{ Form::close() }}

