{{Form::open(array('url'=>'sendQuotation','method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    {{Form::hidden('lead_id',$lead->id,array('class'=>'form-control','required'=>'required'))}}
    @csrf
    <div class="col-3">
        <div class="form-group">
            {{Form::label('product_id',__('Product'),['class'=>'form-label']) }}
            {{ Form::select('product_id',$products,null,array('class'=>'form-control','required'=>'required', 'id' => 'product-select')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Download'),array('class'=>'btn btn-primary '))}}
</div>
</div>
{{Form::close()}}
