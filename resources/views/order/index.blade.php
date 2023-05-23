@extends('layouts.admin')
@push('script-page')
@endpush
@section('page-title')
    {{__('Order')}}
@endsection
@section('title')
    {{__('Order')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Order')}}</li>
@endsection
@section('action-btn')
@endsection
@section('content')


<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table datatable align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"> {{__('Order Id')}}</th>
                                    <th scope="col" class="sort" data-sort="budget">{{__('Date')}}</th>
                                    <th scope="col" class="sort" data-sort="status">{{__('Name')}}</th>
                                    <th scope="col">{{__('Plan Name')}}</th>
                                    <th scope="col" class="sort" data-sort="completion"> {{__('Price')}}</th>
                                    <th scope="col" class="sort" data-sort="completion"> {{__('Payment Type')}}</th>
                                    <th scope="col" class="sort" data-sort="completion"> {{__('Status')}}</th>
                                    <th scope="col" class="sort" data-sort="completion"> {{__('Coupon')}}</th>
                                    <th scope="col" class="sort text-center" data-sort="completion"> {{__('Invoice')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            {{-- <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input">
                                                </div>
                                                {{$order->order_id}}
                                            </div> --}}
                                            {{$order->order_id}}
                                        </td>
                                        <td>{{$order->created_at->format('d M Y')}}</td>
                                        <td>{{$order->user_name}}</td>
                                        <td>{{$order->plan_name}}</td>
                                        <td>{{env('CURRENCY_SYMBOL').$order->price}}</td>
                                        <td>{{$order->payment_type}}</td>

                                        <td>
                                            @if($order->payment_status == 'succeeded')
                                                <span class="d-flex align-items-center">
                                                    <i class="f-20 lh-1 ti ti-circle-check text-success"></i>
                                                    <span class="ms-1">{{ucfirst($order->payment_status)}}</span>
                                                </span>
                                            @else
                                                <span class="d-flex align-items-center">
                                                    <i class="f-20 lh-1 ti ti-circle-x text-danger"></i>
                                                    <span class="ms-1">{{ucfirst($order->payment_status)}}</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{!empty($order->total_coupon_used)? !empty($order->total_coupon_used->coupon_detail)?$order->total_coupon_used->coupon_detail->code:'-':'-'}}</td>
                                        <td class="text-center">
                                            @if($order->receipt != 'free coupon' && $order->payment_type == 'STRIPE')
                                                <a href="{{$order->receipt}}" title="Invoice" target="_blank" class=""><i class="fas fa-file-invoice"></i> </a>
                                            @elseif($order->receipt =='free coupon')
                                                <p>{{__('Used 100 % discount coupon code.')}}</p>
                                            @elseif($order->payment_type == 'Manually')
                                                <p>{{__('Manually plan upgraded by super admin')}}</p>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

