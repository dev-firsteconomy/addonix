@extends('layouts.admin')

@section('title')
<div class="page-header-title">
    {{__('View Subscription')}}
</div>
@endsection
<style>
.table-data {
    margin: 0px 0px 10px;;
    border-collapse: collapse;
}

.table-data >* {
    border: 1px solid #ced4da;
    padding: 6px 15px;
    border-collapse: collapse;
}

.table-data dd {
    margin-bottom: 0;
}

.table-data dt {
    text-transform: capitalize;
}

.table-data dt span.h6 {
    font-size: 14px !important;
}
.btn-center{
    display: flex;
    align-items: center;
    justify-content: center;
}

.table-responsive .dropdown-toggle::after {
    display: none;
}
.viewDropdown{
    width: 40px; 
    display: inline-block; 
    margin:10px;
}
</style>
@section('action-btn')
<div class="btn-group" role="group">
    <div class="action-btn  ms-2">
        <a href="{{ request()->headers->get('referer') }}" class="btn btn-sm btn-primary btn-icon m-1">
            Back
        </a>
    </div>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{route('lead.index')}}">{{__('Lead')}}</a></li>
<li class="breadcrumb-item">{{__('View Subscription')}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <!-- Subscription Section -->
            <dl class="row table-data">
                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Company Name')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->lead->company_name }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Product Type')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->product_type }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Start Date')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->subscription_start_date }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('End Date')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->subscription_end_date }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Contract Value')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->contract_value }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Contract Terms')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->contract_terms }}</span></dd>

                @if($subscription->is_renew)
                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Contract Sub Type')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->contract_sub_type }}</span></dd>
                @endif

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Created By')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->Owner->name }}</span></dd>

                <dt class="col-md-4"><span class="h6 text-md mb-0">{{__('Created At')}}</span></dt>
                <dd class="col-md-8"><span class="text-md">{{ $subscription->created_at }}</span></dd>
            </dl>
            <!-- Subscription Section -->
            
            <dl class="row viewData">
                <!-- Product Section -->
                <div class="col-12">
                    <hr class="mt-2 mb-2">
                    <h5>Product</h5>
                </div>

                <div class="col-12 table-responsive">
                    <table id="data" class="table data-table data-table-horizontal data-table-highlight">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>
                                    <p class="mb-0">License</p>
                                </th>
                                <th>
                                    <p class="mb-0">Product Name</p>
                                </th>
                                <th>
                                    <p class="mb-0">Quantity</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach ($subscription->subscriptionProducts as $item)
                            <?php 
                                $product = \App\Models\Product::find($item->product_id);
                            ?>
                            <tr>
                                <td scope="col">{{ $i}}</td>
                                <td scope="col">{{ $item->license}}</td>
                                <td scope="col">{{ $product->name}}</td>
                                <td scope="col">{{ $item->quantity}}</td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Product Section -->
            </dl>
        </div>
    </div>
</div>
@endsection
@push('script-page')
@endpush
