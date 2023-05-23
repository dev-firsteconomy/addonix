@extends('layouts.admin')
@php
    $dir = asset(Storage::url('uploads/plan'));

@endphp
@push('script-page')
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>

    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        $(document).ready(function() {

        });

        $(document).on('click', '.apply-coupon', function(e) {
            e.preventDefault();
            var where = $(this).attr('data-from');
            applyCoupon($('#' + where + '_coupon').val(), where);
        })
        function applyCoupon(coupon_code, where) {

            if (coupon_code != '') {
                $.ajax({
                    url: '{{ route('apply.coupon') }}',
                    datType: 'json',
                    data: {
                        plan_id: '{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}',
                        coupon: coupon_code,
                        frequency:$('input[name="' + where + '_payment_frequency"]:checked').val()
                    },
                    success: function(data) {
                        // alert(data.is_success);
                        // if(ele.closest($('#payfast-form')).length == 1){
                            get_payfast_status(data.price,coupon);
                        // }

                        if (data.is_success == true) {
                            $('.' + where + '-coupon-tr').show().find('.' + where + '-coupon-price').text(data
                                .discount_price);
                            $('.' + where + '-final-price').text(data.final_price);
                        } else {

                            $('.' + where + '-coupon-tr').hide().find('.' + where + '-coupon-price').text('');
                            $('.' + where + '-final-price').text(data.final_price);
                            show_toastr('Error', data.message, 'error');
                        }
                    }
                })
            } else {
                show_toastr('Error', '{{ __('Invalid Coupon Code.') }}', 'error');
                $('.' + where + '-coupon-tr').hide().find('.' + where + '-coupon-price').text('');
            }
        }

    </script>
    <script type="text/javascript">
        @if (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' && !empty($admin_payment_setting['stripe_key']) && !empty($admin_payment_setting['stripe_secret']))
        var stripe = Stripe('{{ $admin_payment_setting['stripe_key'] }}');
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '14px',
                    color: '#32325d',
                },
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            // Create a token or display an error when the form is submitted.
            var form = document.getElementById('payment-form');

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        $("#card-errors").html(result.error.message);
                        toastrs('Error', result.error.message, 'error');
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        @endif
    </script>


    @if (
        !empty($admin_payment_setting['is_paystack_enabled']) &&
            isset($admin_payment_setting['is_paystack_enabled']) &&
            $admin_payment_setting['is_paystack_enabled'] == 'on')
        <script src="https://js.paystack.co/v1/inline.js"></script>

        <script>
            $(document).on("click", "#pay_with_paystack", function() {

                $('#paystack-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {
                        var coupon_id = res.coupon;

                        var paystack_callback = "{{ url('/plan/paystack') }}";
                        var order_id = '{{ time() }}';
                        var handler = PaystackPop.setup({
                            key: '{{ $admin_payment_setting['paystack_public_key'] }}',
                            email: res.email,
                            amount: res.total_price * 100,
                            currency: res.currency,
                            ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                                1
                            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                            metadata: {
                                custom_fields: [{
                                    display_name: "Email",
                                    variable_name: "email",
                                    value: res.email,
                                }]
                            },

                            callback: function(response) {
                                console.log(response.reference, order_id);
                                window.location.href = paystack_callback + '/' + response
                                    .reference + '/' + '{{ encrypt($plan->id) }}' + '?coupon_id=' +
                                    coupon_id
                            },
                            onClose: function() {
                                alert('window closed');
                            }
                        });
                        handler.openIframe();
                    } else if (res.flag == 2) {

                    } else {
                        show_toastr('Error', data.message, 'msg');
                    }

                }).submit();
            });
        </script>
    @endif

    @if (
        !empty($admin_payment_setting['is_flutterwave_enabled']) &&
            isset($admin_payment_setting['is_flutterwave_enabled']) &&
            $admin_payment_setting['is_flutterwave_enabled'] == 'on')
        <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

        <script>
            //    Flaterwave Payment
            $(document).on("click", "#pay_with_flaterwave", function() {

                $('#flaterwave-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {
                        var coupon_id = res.coupon;
                        var API_publicKey = '';
                        if ("{{ isset($admin_payment_setting['flutterwave_public_key']) }}") {
                            API_publicKey = "{{ $admin_payment_setting['flutterwave_public_key'] }}";
                        }
                        var nowTim = "{{ date('d-m-Y-h-i-a') }}";
                        var flutter_callback = "{{ url('/plan/flaterwave') }}";
                        var x = getpaidSetup({
                            PBFPubKey: API_publicKey,
                            customer_email: '{{ Auth::user()->email }}',
                            amount: res.total_price,
                            currency: res.currency,
                            txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) +
                                'fluttpay_online-' +
                                {{ date('Y-m-d') }},
                            meta: [{
                                metaname: "payment_id",
                                metavalue: "id"
                            }],
                            onclose: function() {},
                            callback: function(response) {
                                var txref = response.tx.txRef;
                                if (
                                    response.tx.chargeResponseCode == "00" ||
                                    response.tx.chargeResponseCode == "0"
                                ) {
                                    window.location.href = flutter_callback + '/' + txref + '/' +
                                        '{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}?coupon_id=' +
                                        coupon_id + '&payment_frequency=' + res.payment_frequency;
                                } else {
                                    // redirect to a failure page.
                                }
                                x.close(); // use this to close the modal immediately after payment.
                            }
                        });
                    } else if (res.flag == 2) {

                    } else {
                        show_toastr('Error', data.message, 'msg');
                    }

                }).submit();
            });
        </script>
    @endif

    @if (
        !empty($admin_payment_setting['is_razorpay_enabled']) &&
            isset($admin_payment_setting['is_razorpay_enabled']) &&
            $admin_payment_setting['is_razorpay_enabled'] == 'on')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            // Razorpay Payment

            $(document).on("click", "#pay_with_razorpay", function() {
                $('#razorpay-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {

                        var razorPay_callback = '{{ url('/plan/razorpay') }}';
                        var totalAmount = res.total_price * 100;
                        var coupon_id = res.coupon;
                        var API_publicKey = '';
                        if ("{{ isset($admin_payment_setting['razorpay_public_key']) }}") {
                            API_publicKey = "{{ $admin_payment_setting['razorpay_public_key'] }}";
                        }
                        var options = {
                            "key": API_publicKey, // your Razorpay Key Id
                            "amount": totalAmount,
                            "name": 'Plan',
                            "currency": res.currency,
                            "description": "",
                            "handler": function(response) {
                                window.location.href = razorPay_callback + '/' + response
                                    .razorpay_payment_id + '/' +
                                    '{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}?coupon_id=' +
                                    coupon_id + '&payment_frequency=' + res.payment_frequency;
                            },
                            "theme": {
                                "color": "#528FF0"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else if (res.flag == 2) {

                    } else {
                        show_toastr('Error', data.message, 'msg');
                    }

                }).submit();
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            get_payfast_status(amount = 0, coupon = null);
        })

        function get_payfast_status(amount, coupon) {
            var plan_id = $('#plan_id').val();

            $.ajax({
                url: '{{ route('payfast.payment') }}',
                method: 'POST',
                data: {
                    'plan_id': plan_id,
                    'coupon_amount': amount,
                    'coupon_code': coupon
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    if (data.success == true) {
                        $('#get-payfast-inputs').append(data.inputs);

                    } else {
                        show_toastr('Error', data.inputs, 'error')
                    }
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>
@endpush
@php
    $dir = asset(Storage::url('uploads/plan'));
    $dir_payment = asset(Storage::url('uploads/payments'));
@endphp
@section('page-title')
    {{ __('Order Summary') }}
@endsection
@section('title')
    {{ __('Order Summary') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plan.index') }}">{{ __('Plan') }}</a></li>
    <li class="breadcrumb-item">{{ __('Order Summary') }}</li>
@endsection
@section('action-btn')
@endsection
@section('content')
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @if (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on')
                                <a href="#useradd-1"
                                    class="list-group-item list-group-item-action border-0">{{ __('Stripe') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on')
                                <a href="#useradd-2"
                                    class="list-group-item list-group-item-action border-0">{{ __('Paypal') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')
                                <a href="#useradd-3"
                                    class="list-group-item list-group-item-action border-0">{{ __('Paystack') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                                <a href="#useradd-4"
                                    class="list-group-item list-group-item-action border-0">{{ __('Flutterwave') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                                <a href="#useradd-5"
                                    class="list-group-item list-group-item-action border-0">{{ __('Razorpay') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                                <a href="#useradd-6"
                                    class="list-group-item list-group-item-action border-0">{{ __('Paytm') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                                <a href="#useradd-7"
                                    class="list-group-item list-group-item-action border-0">{{ __('Mercado Pago') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                                <a href="#useradd-8"
                                    class="list-group-item list-group-item-action border-0">{{ __('Mollie') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                                <a href="#useradd-9"
                                    class="list-group-item list-group-item-action border-0">{{ __('Skrill') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                                <a href="#useradd-10"
                                    class="list-group-item list-group-item-action border-0">{{ __('Coingate') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                                <a href="#useradd-11"
                                    class="list-group-item list-group-item-action border-0">{{ __('PaymentWall') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on')
                                <a href="#useradd-12"
                                    class="list-group-item list-group-item-action border-0">{{ __('Toyyibpay') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            @if (isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on')
                                <a href="#useradd-13"
                                    class="list-group-item list-group-item-action border-0">{{ __('Payfast') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    {{-- @if (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on')
                <div id="useradd-1" class="card {{ (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on') ? "active" : "d-none" }}">
                    <form class="w3-container w3-display-middle w3-card-4" method="POST" id="stripe-payment-form" action="{{ route('stripe.post') }}">
                        @csrf
                    <div class="card-header">
                        <h5>{{ __('Stripe') }}</h5>
                        <small class="text-muted">{{__('Details about your plan stript payment')}}</small>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row mt-3">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="stripe_coupon" class="form-label">{{__('Coupon')}}</label>
                                        <input type="text" id="stripe_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                    </div>
                                </div>
                                <div class="col-md-2 coupon-apply-btn">
                                    <div class="form-group apply-stripe-btn-coupon">
                                        <a href="#" class="btn btn-primary align-items-center" data-from="stripe">{{ __('Apply') }}</a>
                                    </div>
                                </div>
                                <div class="col-12 text-right stripe-coupon-tr" style="display: none">
                                    <b>{{__('Coupon Discount')}}</b> : <b class="stripe-coupon-price"></b>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="float-end">
                                            <input type="hidden" id="stripe" value="stripe" name="payment_processor" class="custom-control-input">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary d-flex align-items-center" type="submit">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="stripe-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="error" style="display: none;">
                                        <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </form>
                </div>
                @endif --}}



                    @if (
                        $admin_payment_setting['is_stripe_enabled'] == 'on' &&
                            !empty($admin_payment_setting['stripe_key']) &&
                            !empty($admin_payment_setting['stripe_secret']))
                        <div id="useradd-1" class="card">
                            <div class="card-header">
                                <h5 class=" h6 mb-0">{{ __('Stripe') }}</h5>
                                <small class="text-muted">{{ __('Details about your plan stript payment') }}</small>
                            </div>
                            <div class="card-body">
                                <form role="form" action="{{ route('stripe.post') }}" method="post"
                                    class="require-validation" id="payment-form">
                                    @csrf

                                    <div class=" rounded stripe-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="form-label" for="card-name-on"
                                                        class="form-label">{{ __('Name on card') }}</label>
                                                    <input type="text" name="name" id="card-name-on"
                                                        class="form-control required"
                                                        placeholder="{{ \Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div id="card-element"></div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                            <div class="col-md-10">
                                                <br>
                                                <div class="form-group">
                                                    <label class="form-label" for="stripe_coupon"
                                                        class="form-label">{{ __('Coupon') }}</label>
                                                    <input type="text" id="stripe_coupon" name="coupon"
                                                        class="form-control coupon"
                                                        placeholder="{{ __('Enter Coupon Code') }}"
                                                        data-from="stripe_coupon">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn mt-5 mb-0">
                                                <div class="form-group apply-stripe-btn-coupon">
                                                    <a href="#"
                                                        class="btn btn-primary coupon-apply-btn apply-coupon btn-m">{{ __('Apply') }}</a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="error" style="display: none;">
                                                        <div class='alert-danger alert'>
                                                            {{ __('Please correct the errors and try again.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="float-end">
                                                    <input type="hidden" id="stripe" value="stripe"
                                                        name="payment_processor" class="custom-control-input">
                                                    <input type="hidden" name="plan_id"
                                                        value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                    <button class="btn btn-primary d-flex align-items-center mx-4"
                                                        type="submit">
                                                        <i class="mdi mdi-cash-multiple "></i> {{ __('Pay Now') }} (<span
                                                            class="stripe-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on')
                        <div id="useradd-2" class="card ">
                            <form class="w3-container w3-display-middle w3-card-4" method="POST"
                                id="paypal-payment-form" action="{{ route('plan.pay.with.paypal') }}">
                                @csrf <div class="card-header">
                                    <h5>{{ __('Paypal') }}</h5>
                                    <small class="text-muted">{{ __('Details about your plan paypal payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paypal_coupon"
                                                        class="form-label">{{ __('Coupon') }}</label>
                                                    <input type="text" id="paypal_coupon" name="coupon"
                                                        class="form-control coupon"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paypal-btn-coupon">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="paypal">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paypal-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="paypal-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i> {{ __('Pay Now') }}
                                                            (<span
                                                                class="paypal-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')
                        <div id="useradd-3" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.paystack') }}" method="post"
                                id="paystack-payment-form" class="w3-container w3-display-middle w3-card-4">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Paystack') }}</h5>
                                    <small class="text-muted">{{ __('Details about your plan Paystack payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paystack_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="paystack_coupon" name="coupon"
                                                        class="form-control coupon" data-from="paystack"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paystack-btn-coupon">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="paystack">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paystack-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="paystack-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="button" id="pay_with_paystack">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i> {{ __('Pay Now') }}
                                                            (<span
                                                                class="paystack-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                        <div id="useradd-4" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.flaterwave') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="flaterwave-payment-form">
                                @csrf <div class="card-header">
                                    <h5>{{ __('Flutterwave') }}</h5>
                                    <small
                                        class="text-muted">{{ __('Details about your plan Flutterwave payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="flaterwave_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="flaterwave_coupon" name="coupon"
                                                        class="form-control coupon" data-from="flaterwave"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="flaterwave">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right flaterwave-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b
                                                    class="flaterwave-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="button" id="pay_with_flaterwave">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i> {{ __('Pay Now') }}
                                                            (<span
                                                                class="flaterwave-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                        <div id="useradd-5" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.razorpay') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="razorpay-payment-form">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Razorpay') }}</h5>
                                    <small class="text-muted">{{ __('Details about your plan Razorpay payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="razorpay_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="razorpay_coupon" name="coupon"
                                                        class="form-control coupon" data-from="razorpay"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary  align-items-center apply-coupon"
                                                        data-from="razorpay">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right razorpay-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="razorpay-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="button" id="pay_with_razorpay">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i> {{ __('Pay Now') }}
                                                            (<span
                                                                class="razorpay-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                        <div id="useradd-6" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.paytm') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="paytm-payment-form">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Paytm') }}</h5>
                                    <small class="text-muted">{{ __('Details about your plan Paytm payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="paytm_coupon"
                                                        class="form-label text-dark">{{ __('Mobile Number') }}</label>
                                                    <input type="text" id="mobile" name="mobile"
                                                        class="form-control mobile" data-from="mobile"
                                                        placeholder="{{ __('Enter Mobile Number') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="paytm_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="paytm_coupon" name="coupon"
                                                        class="form-control coupon" data-from="paytm"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="paytm">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paytm-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="paytm-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_paytm">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="paytm-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                        <div id="useradd-7" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.mercado') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="mercado-payment-form">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Mercado Pago') }}</h5>
                                    <small
                                        class="text-muted">{{ __('Details about your plan Mercado Pago payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="mercado_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="mercado_coupon" name="coupon"
                                                        class="form-control coupon" data-from="mercado"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="mercado">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right mercado-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="mercado-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_paytm">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="mercado-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                        <div id="useradd-8" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.mollie') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="mollie-payment-form">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Mollie') }}</h5>
                                    <small class="text-muted">{{ __('Details about your plan Mollie payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="mollie_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="mollie_coupon" name="coupon"
                                                        class="form-control coupon" data-from="mollie"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="mollie">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right mollie-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="mollie-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_mollie">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="mollie-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                        <div id="useradd-9" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.skrill') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="skrill-payment-form">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Skrill') }}</h5>
                                    <small class="text-muted">{{ __('Details about your plan Skrill payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="skrill_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="skrill_coupon" name="coupon"
                                                        class="form-control coupon" data-from="skrill"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="skrill">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right skrill-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b class="skrill-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_skrill">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="skrill-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $skrill_data = [
                                                'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                'user_id' => 'user_id',
                                                'amount' => 'amount',
                                                'currency' => 'currency',
                                            ];
                                            session()->put('skrill_data', $skrill_data);
                                        @endphp
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                        <div id="useradd-10" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.coingate') }}" method="post"
                                class="w3-container w3-display-middle w3-card-4" id="coingate-payment-form">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Coingate') }}</h5>
                                    <small
                                        class="text-muted">{{ __('Details about your plan Coingate payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="coingate_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="coingate_coupon" name="coupon"
                                                        class="form-control coupon" data-from="coingate"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="coingate">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right coingate-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b
                                                    class="coingate-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_coingate">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="coingate-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                        <div id="useradd-11" class="card ">
                            <form role="form" action="{{ route('paymentwall') }}" method="post"
                                id="paymentwall-payment-form" class="w3-container w3-display-middle w3-card-4">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('PaymentWall') }}</h5>
                                    <small
                                        class="text-muted">{{ __('Details about your plan PaymentWall payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paymentwall_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="paymentwall_coupon" name="coupon"
                                                        class="form-control coupon" data-from="paymentwall"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paymentwall-btn-coupon">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="paymentwall">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paymentwall-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b
                                                    class="paymentwall-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_paymentwall">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="paymentwall-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on')
                        <div id="useradd-12" class="card ">
                            <form role="form" action="{{ route('plan.pay.with.toyyibpay') }}" method="post"
                                id="toyyibpay-payment-form" class="w3-container w3-display-middle w3-card-4">
                                @csrf
                                <div class="card-header">
                                    <h5>{{ __('Toyyibpay') }}</h5>
                                    <small
                                        class="text-muted">{{ __('Details about your plan Toyyibpay payment') }}</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mt-3">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="toyyibpay_coupon"
                                                        class="form-label text-dark">{{ __('Coupon') }}</label>
                                                    <input type="text" id="toyyibpay_coupon" name="coupon"
                                                        class="form-control coupon" data-from="toyyibpay"
                                                        placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-toyyibpay-btn-coupon">
                                                    <a href="#"
                                                        class="btn btn-primary align-items-center apply-coupon"
                                                        data-from="toyyibpay">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right toyyibpay-coupon-tr" style="display: none">
                                                <b>{{ __('Coupon Discount') }}</b> : <b
                                                    class="toyyibpay-coupon-price"></b>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    <div class="float-end">
                                                        <input type="hidden" name="plan_id"
                                                            value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                        <button class="btn btn-primary d-flex align-items-center"
                                                            type="submit" id="pay_with_toyyibpay">
                                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                                            {{ __('Pay Now') }} (<span
                                                                class="toyyibpay-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>
                                                        {{ __('Please correct the errors and try again.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    @endif
                    @if (isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on')
                        <div id="useradd-13" class="card">
                            <div class="card-header">
                                <h5>{{ __('Payfast') }}</h5>
                            </div>

                            {{-- <div class="card-body"> --}}
                            {{-- @dd($admin_payment_setting); --}}
                            @if (
                                $admin_payment_setting['is_payfast_enabled'] == 'on' &&
                                    !empty($admin_payment_setting['payfast_merchant_id']) &&
                                    !empty($admin_payment_setting['payfast_merchant_key']) &&
                                    !empty($admin_payment_setting['payfast_signature']) &&
                                    !empty($admin_payment_setting['payfast_mode']))
                                <div
                                    {{ ($admin_payment_setting['is_payfast_enabled'] == 'on' && !empty($admin_payment_setting['payfast_merchant_id']) && !empty($admin_payment_setting['payfast_merchant_key'])) == 'on' ? 'active' : '' }}>
                                    @php
                                        $pfHost = $admin_payment_setting['payfast_mode'] == 'sandbox' ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
                                    @endphp
                                    <form role="form" action={{ 'https://' . $pfHost . '/eng/process' }}
                                        method="post" class="require-validation" id="payfast-form">
                                        <div class="border p-3 rounded ">

                                            <div class="row mt-3">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="payfast_coupon"
                                                            class="form-label text-dark">{{ __('Coupon') }}</label>
                                                        <input type="text" id="payfast_coupon" name="coupon"
                                                            class="form-control coupon" data-from="payfast"
                                                            placeholder="{{ __('Enter Coupon Code') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 coupon-apply-btn">
                                                    <div class="form-group apply-payfast-btn-coupon">
                                                        <a href="#"
                                                            class="btn btn-primary align-items-center apply-coupon"
                                                            data-from="payfast">{{ __('Apply') }}</a>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-right payfast-coupon-tr" style="display: none">
                                                    <b>{{ __('Coupon Discount') }}</b> : <b
                                                        class="payfast-coupon-price"></b>
                                                </div>

                                                <div id="get-payfast-inputs"></div>
                                                <div class="row mt-2">
                                                    <div class="col-sm-12">
                                                        <div class="float-end">
                                                            <input type="hidden" name="plan_id" id="plan_id"
                                                                value="{{ \Illuminate\Support\Facades\Crypt::encrypt($plan->id) }}">
                                                            <button class="btn btn-primary d-flex align-items-center"
                                                                type="submit" id="pay_with_payfast">
                                                                <i class="mdi mdi-cash-multiple mr-1"></i>
                                                                {{ __('Pay Now') }} (<span
                                                                    class="payfast-final-price">{{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price }}</span>)</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif




                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>


    {{-- <div class="row">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{$plan->name}}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center plan-box">
                    <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                        <img alt="Image placeholder" src="{{$dir.'/'.$plan->image}}" class="">
                    </a>

                    <h5 class="h6 my-4 "><span class="final-price">{{env('CURRENCY_SYMBOL').$plan->price}}</span> {{' / '.__(\App\Models\Plan::$arrDuration[$plan->duration])}}</h5>

                    @if (\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id)
                        <h5 class="h6 my-4">
                            {{__('Expired : ')}} {{\Auth::user()->plan_expire_date ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date):__('Unlimited')}}
                        </h5>
                    @endif
                    <h5 class="h6 my-4">{{$plan->description}}</h5>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 text-center">
                            <span class="h5 mb-0">{{$plan->max_employee}}</span>
                            <span class="d-block text-sm">{{__('Employee')}}</span>
                        </div>
                        <div class="col-6 text-center">
                            <span class="h5 mb-0">{{$plan->max_client}}</span>
                            <span class="d-block text-sm"> {{__('Client')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-4 order-lg-2">
                    <div class="card plan-stripe-box">
                        <div class="list-group list-group-flush" id="tabs">


                            @if (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on')
                                <div data-href="#stripe-payment" class="custom-list-group-item list-group-item text-primary">
                                    <div class="media">
                                        <i class="fas fa-cog pt-1"></i>
                                        <div class="media-body ml-3">
                                            <a href="#" class="stretched-link h6 mb-1">{{__('Stripe')}}</a>
                                            <p class="mb-0 text-sm">{{__('Details about your plan stript payment')}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                                @if (isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on')
                                    <div data-href="#paypal-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Paypal')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan paypal payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')
                                    <div data-href="#paystack-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Paystack')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Paystack payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')
                                    <div data-href="#flutterwave-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Flutterwave')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Flutterwave payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')
                                    <div data-href="#razorpay-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Razorpay')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Razorpay payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                                    <div data-href="#paytm-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Paytm')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Paytm payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                                    <div data-href="#mercadopago-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Mercado Pago')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Mercado Pago payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')
                                    <div data-href="#mollie-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Mollie')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Mollie payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                                    <div data-href="#skrill-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Skrill')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Skrill payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')
                                    <div data-href="#coingate-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('Coingate')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan Coingate payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                 @if (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                                    <div data-href="#paymentwall-payment" class="custom-list-group-item list-group-item text-primary">
                                        <div class="media">
                                            <i class="fas fa-cog pt-1"></i>
                                            <div class="media-body ml-3">
                                                <a href="#" class="stretched-link h6 mb-1">{{__('PaymentWall')}}</a>
                                                <p class="mb-0 text-sm">{{__('Details about your plan PaymentWall payment')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif



                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-lg-1">

                    @if (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on')

                        <div id="stripe-payment" class="tabs-card {{ (isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on') ? "active" : "d-none" }}">
                            <div class="card ">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="stripe-payment-form" action="{{ route('stripe.post') }}">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Stripe')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box stripe-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="stripe_coupon">{{__('Coupon')}}</label>
                                                    <input type="text" id="stripe_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-stripe-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="stripe">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right stripe-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="stripe-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" id="stripe" value="stripe" name="payment_processor" class="custom-control-input">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="stripe-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on')

                        <div id="paypal-payment" class="tabs-card d-none">
                            <div class="card ">
                                <form class="w3-container w3-display-middle w3-card-4" method="POST" id="paypal-payment-form" action="{{ route('plan.pay.with.paypal') }}">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Paypal')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paypal-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paypal_coupon">{{__('Coupon')}}</label>
                                                    <input type="text" id="paypal_coupon" name="coupon" class="form-control coupon" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paypal-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paypal">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paypal-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paypal-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paypal-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif


                    @if (isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on')
                        <div class="tabs-card d-none" id="paystack-payment">
                            <div class="card">
                                <form role="form" action="{{ route('plan.pay.with.paystack') }}" method="post" id="paystack-payment-form" class="w3-container w3-display-middle w3-card-4">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Paystack')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paystack-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paystack_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="paystack_coupon" name="coupon" class="form-control coupon" data-from="paystack" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paystack-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paystack">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paystack-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paystack-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="button" id="pay_with_paystack">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paystack-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if (isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on')

                        <div class="tabs-card d-none" id="flutterwave-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.flaterwave') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="flaterwave-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Flutterwave')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box flaterwave-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="flaterwave_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="flaterwave_coupon" name="coupon" class="form-control coupon" data-from="flaterwave" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="flaterwave">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right flaterwave-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="flaterwave-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="button" id="pay_with_flaterwave">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="flaterwave-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    @endif

                    @if (isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on')

                        <div class="tabs-card d-none" id="razorpay-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.razorpay') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="razorpay-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Razorpay')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box razorpay-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="razorpay_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="razorpay_coupon" name="coupon" class="form-control coupon" data-from="razorpay" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="razorpay">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right razorpay-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="razorpay-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="button" id="pay_with_razorpay">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="razorpay-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{ $plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if (isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on')
                        <div class="tabs-card d-none" id="paytm-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.paytm') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="paytm-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Paytm')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paytm-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="paytm_coupon" class="form-control-label text-dark">{{__('Mobile Number')}}</label>
                                                    <input type="text" id="mobile" name="mobile" class="form-control mobile" data-from="mobile" placeholder="{{ __('Enter Mobile Number') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="paytm_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="paytm_coupon" name="coupon" class="form-control coupon" data-from="paytm" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paytm">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paytm-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paytm-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit" id="pay_with_paytm">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paytm-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if (isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on')
                        <div class="tabs-card d-none" id="mercadopago-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.mercado') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="mercado-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Mercado Pago')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box mercado-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="mercado_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="mercado_coupon" name="coupon" class="form-control coupon" data-from="mercado" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="mercado">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right mercado-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="mercado-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit" id="pay_with_paytm">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="mercado-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                    @if (isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on')

                        <div class="tabs-card d-none" id="mollie-payment">
                            <div class="card">
                                <form role="form" action="{{ route('plan.pay.with.mollie') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="mollie-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Mollie')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box mollie-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="mollie_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="mollie_coupon" name="coupon" class="form-control coupon" data-from="mollie" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="mollie">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right mollie-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="mollie-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit" id="pay_with_mollie">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="mollie-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif


                    @if (isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on')
                        <div class="tabs-card d-none" id="skrill-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.skrill') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="skrill-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Skrill')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box skrill-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="skrill_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="skrill_coupon" name="coupon" class="form-control coupon" data-from="skrill" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="skrill">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right skrill-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="skrill-coupon-price"></b>
                                            </div>
                                        </div>
                                        @php
                                            $skrill_data = [
                                                'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                'user_id' => 'user_id',
                                                'amount' => 'amount',
                                                'currency' => 'currency',
                                            ];
                                            session()->put('skrill_data', $skrill_data);
                                        @endphp
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit" id="pay_with_skrill">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="skrill-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{ $plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on')

                        <div class="tabs-card d-none" id="coingate-payment">
                            <div class="card ">
                                <form role="form" action="{{ route('plan.pay.with.coingate') }}" method="post" class="w3-container w3-display-middle w3-card-4" id="coingate-payment-form">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using Coingate')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box coingate-payment-div">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="coingate_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="coingate_coupon" name="coupon" class="form-control coupon" data-from="coingate" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group pt-3 mt-3">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="coingate">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right coingate-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="coingate-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">

                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit" id="pay_with_coingate">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="coingate-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{ $plan->price }}</span>)
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif



                    @if (isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')
                        <div class="tabs-card d-none" id="paymentwall-payment">
                            <div class="card">
                                <form role="form" action="{{ route('paymentwall') }}" method="post" id="paymentwall-payment-form" class="w3-container w3-display-middle w3-card-4">
                                    @csrf
                                    <br><h5 class="h6 mb-2 ml-3">{{__('Pay Using PaymentWall')}}</h5>
                                    <div class="border p-3 mb-3 rounded payment-box paymentwall-payment-div">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="paymentwall_coupon" class="form-control-label text-dark">{{__('Coupon')}}</label>
                                                    <input type="text" id="paymentwall_coupon" name="coupon" class="form-control coupon" data-from="paymentwall" placeholder="{{ __('Enter Coupon Code') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 coupon-apply-btn">
                                                <div class="form-group apply-paymentwall-btn-coupon">
                                                    <a href="#" class="btn btn-primary apply-coupon btn-sm" data-from="paymentwall">{{ __('Apply') }}</a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right paymentwall-coupon-tr" style="display: none">
                                                <b>{{__('Coupon Discount')}}</b> : <b class="paymentwall-coupon-price"></b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="error" style="display: none;">
                                                    <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mr-3">
                                        <div class="text-sm-right">
                                            <input type="hidden" name="plan_id" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                                            <button class="btn btn-primary btn-sm" type="submit" id="pay_with_paymentwall">
                                                <i class="mdi mdi-cash-multiple mr-1"></i> {{__('Pay Now')}} (<span class="paymentwall-final-price">{{(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')}}{{$plan->price }}</span>)</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div> --}}
@endsection
