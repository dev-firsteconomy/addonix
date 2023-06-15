@extends('layouts.admin')
@section('page-title')
    {{__('Product')}}
@endsection
@section('title')
        {{__('Edit Product')}} {{ '('. $product->name .')' }}
@endsection
@section('action-btn')
    <div class="btn-group" role="group">
        @if(!empty($previous))
        <div class="action-btn  ms-2">
            <a href="{{ route('product.edit',$previous) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        @else
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        @endif
        @if(!empty($next))
        <div class="action-btn ms-2">
            <a href="{{ route('product.edit',$next) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Next')}}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        @else
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Next')}}">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        @endif
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('product.index')}}">{{__('Product')}}</a></li>
    <li class="breadcrumb-item">{{__('Edit')}}</li>
@endsection
@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <!-- <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action">{{ __('Overview') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-12">
                @if (Session::has('message'))
                <div id="success-message" class="alert alert-success" role="alert" >
                    {{ Session::get('message') }}
                </div>
                @endif
                <div id="useradd-1" class="card">
                    {{Form::model($product,array('route' => array('product.update', $product->id), 'method' => 'PUT')) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{__('Edit about your product information')}}</small>
                    </div>
        
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                        @error('name')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('status',__('Status'),['class'=>'form-label']) }}
                                        {!!Form::select('status', $status, null,array('class' => 'form-control','required'=>'required')) !!}
                                        @error('status')
                                        <span class="invalid-status" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('category',__('Category'),['class'=>'form-label']) }}
                                        {!!Form::select('category', $category, null,array('class' => 'form-control','required'=>'required')) !!}
                                        @error('category')
                                        <span class="invalid-category" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('brand',__('Brand'),['class'=>'form-label']) }}
                                        {!!Form::select('brand', $brand, null,array('class' => 'form-control','required'=>'required')) !!}
                                        @error('brand')
                                        <span class="invalid-brand" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div> -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('price',__('Price'),['class'=>'form-label']) }}
                                        {!!Form::text('price', null,array('class' => 'form-control','required'=>'required')) !!}
                                        @error('price')
                                        <span class="invalid-price" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--<div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('tax',__('Tax'),['class'=>'form-label']) }}
                                        {!!Form::select('tax[]', $tax, explode(',',$product->tax),array('class' => 'form-control select2','id'=>'choices-multiple','multiple')) !!}
                                        @error('tax')
                                        <span class="invalid-tax" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('part_number',__('Part Number'),['class'=>'form-label']) }}
                                        {!!Form::number('part_number', null,array('class' => 'form-control','required'=>'required')) !!}
                                        @error('part_number')
                                        <span class="invalid-part_number" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('weight',__('Weight'),['class'=>'form-label']) }}
                                        {{Form::text('weight',null,array('class'=>'form-control','placeholder'=>__('Enter Weight')))}}
                                        @error('weight')
                                        <span class="invalid-weight" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('URL',__('URL'),['class'=>'form-label']) }}
                                        {{Form::textarea('URL',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))}}
                                        @error('URL')
                                        <span class="invalid-URL" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>-->
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('description',__('Description'),['class'=>'form-label']) }}
                                        {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))}}
                                        @error('description')
                                        <span class="invalid-description" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--<div class="col-6">
                                <div class="form-group">
                                    {{Form::label('sku',__('SKU'),['class'=>'form-label']) }}
                                    {!!Form::text('sku',null,array('class' => 'form-control','required'=>'required')) !!}
                                    @error('sku')
                                    <span class="invalid-sku" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                          
    
                                </td>
                               
    
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('user',__('Assigned User'),['class'=>'form-label']) }}
                                        {!! Form::select('user', $user,  $product->user_id,array('class' => 'form-control')) !!}
                                        @error('user')
                                        <span class="invalid-user" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> -->
                                <div class="text-end">
                                    {{Form::submit(__('Update'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>


                                
                            </div>
                        </form>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>



    
@endsection
@push('script-page')
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 3000); // Hide the message after 5 seconds (adjust the timeout value as needed)
    </script>
@endpush