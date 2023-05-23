@extends('layouts.admin')
@section('page-title')
    {{__('Contact Edit')}}
@endsection
@section('title')
        {{__('Edit Contact')}} {{ '('. $contact->name .')' }}
@endsection
@section('action-btn')
    <div class="btn-group" role="group">
        @if(!empty($previous))
        <div class="action-btn  ms-2">
            <a href="{{ route('contact.edit',$previous) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Previous')}}">
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
            <a href="{{ route('contact.edit',$next) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Next')}}">
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
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('contact.index')}}">{{__('Contact')}}</a></li>
    <li class="breadcrumb-item">{{__('Edit')}}</li>
@endsection
@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Overview') }} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0">{{__('Stream')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{__('Opportunities')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-4" class="list-group-item list-group-item-action border-0">{{__('Tasks')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div id="useradd-1" class="card">
                    {{Form::model($contact,array('route' => array('contact.update', $contact->id), 'method' => 'PUT')) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{__('Edit about your contact information')}}</small>
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
                                    {{Form::label('account',__('Account'),['class'=>'form-label']) }}
                                    {!! Form::select('account', $account, null,array('class' => 'form-control')) !!}
                                    </div>
                                    @error('account')
                                    <span class="invalid-account" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                        {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                        @error('email')
                                        <span class="invalid-email" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
                                        {{Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
                                        @error('phone')
                                        <span class="invalid-phone" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('contact_address',__('Address'),['class'=>'form-label']) }}
                                        {{Form::text('contact_address',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Address'),'required'=>'required'))}}
                                        @error('contact_address')
                                        <span class="invalid-contact_address" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('contact_city',__('City'),['class'=>'form-label']) }}
                                        {{Form::text('contact_city',null,array('class'=>'form-control','placeholder'=>__('Enter Billing City'),'required'=>'required'))}}
                                        @error('contact_city')
                                        <span class="invalid-contact_city" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('contact_state',__('State'),['class'=>'form-label']) }}
                                        {{Form::text('contact_state',null,array('class'=>'form-control','placeholder'=>__('Enter Billing City'),'required'=>'required'))}}
                                        @error('contact_state')
                                        <span class="invalid-contact_state" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('contact_postalcode',__('Postal Code'),['class'=>'form-label']) }}
                                        {{Form::text('contact_postalcode',null,array('class'=>'form-control','placeholder'=>__('Enter Billing City'),'required'=>'required'))}}
                                        @error('contact_postalcode')
                                        <span class="invalid-contact_postalcode" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        {{Form::label('contact_country',__('Country'),['class'=>'form-label']) }}
                                        {{Form::text('contact_country',null,array('class'=>'form-control','placeholder'=>__('Enter Billing City'),'required'=>'required'))}}
                                        @error('contact_country')
                                        <span class="invalid-contact_country" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {{Form::label('description',__('Description'),['class'=>'form-label']) }}
                                        {!! Form::textarea('description',null,array('class' =>'form-control ','rows'=>3,'required'=>'required')) !!}
                                        @error('description')
                                        <span class="invalid-description" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                    {{Form::label('user',__(' Assigned User'),['class'=>'form-label']) }}
                                    {!! Form::select('user', $user, $contact->user_id,array('class' => 'form-control ')) !!}
                                    </div>
                                    @error('user')
                                    <span class="invalid-user" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    {{Form::submit(__('Update'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>


                            </div>
                        </form>
                    </div>
                    {{Form::close()}}
                </div>

                <div id="useradd-2" class="card">
                    {{Form::open(array('route' => array('streamstore',['contact',$contact->name,$contact->id]), 'method' => 'post','enctype'=>'multipart/form-data')) }}
                    <div class="card-header">
                        <h5>{{__('Stream')}}</h5>
                        <small class="text-muted">{{__('Add stream information')}}</small>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        {{Form::label('stream',__('Stream'),['class'=>'form-label']) }}
                                        {{Form::text('stream_comment',null,array('class'=>'form-control','placeholder'=>__('Enter Stream Comment'),'required'=>'required'))}}
                                    </div>
                                </div>
                                <input type="hidden" name="log_type" value="contact comment">
                                <div class="col-12 mb-3 field" data-name="attachments">
                                    <div class="attachment-upload">
                                        <div class="attachment-button">
                                            <div class="pull-left">
                                                <div class="form-group">
                                                {{Form::label('attachment',__('Attachment'),['class'=>'form-label']) }}
                                                {{-- {{Form::file('attachment',array('class'=>'form-control'))}} --}}
                                                <input type="file"name="attachment" class="form-control mb-3" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <img id="blah" width="20%" height="20%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="attachments"></div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    {{Form::submit(__('Save'),array('class'=>'btn-submit btn btn-primary'))}}
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="col-12">
                        <div class="card-header">
                            <h5>{{__('Latest comments')}}</h5>
                        </div>
                        @foreach($streams as $stream)
                            @php
                                $remark = json_decode($stream->remark);
                            @endphp
                            @if($remark->data_id == $contact->id)
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xl-12">
                                        <ul class="list-group team-msg">
                                            <li class="list-group-item border-0 d-flex align-items-start mb-2">
                                                <div class="avatar me-3">
                                                    @php
                                                        $profile=\App\Models\Utility::get_file('upload/profile/');
                                                    @endphp
                                                    <a href="{{(!empty($stream->file_upload))? ($profile.$stream->file_upload): asset(url("./assets/images/user/avatar-5.jpg"))}}" target="_blank">
                                                        <img alt="" class="rounded-circle" @if(!empty($stream->file_upload)) src="{{(!empty($stream->file_upload))? ($profile.$stream->file_upload): asset(url("./assets/images/user/avatar-5.jpg"))}}" @else  avatar="{{$remark->user_name}}" @endif>
                                                    </a>
                                                </div>
                                                <div class="d-block d-sm-flex align-items-center right-side">
                                                    <div class="d-flex align-items-start flex-column justify-content-center mb-3 mb-sm-0">
                                                        <div class="h6 mb-1">{{$remark->user_name}}
                                                        </div>
                                                        <span class="text-sm lh-140 mb-0">
                                                            posted to <a href="#">{{$remark->title}}</a> , {{$stream->log_type}}  <a href="#">{{$remark->stream_comment}}</a>
                                                        </span>
                                                    </div>
                                                    <div class=" ms-2  d-flex align-items-center ">
                                                        <small class="float-end ">{{$stream->created_at}}</small>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>


                    {{ Form::close() }}
                </div>

                <div id="useradd-3" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Opportunities') }}</h5>
                                <small class="text-muted">{{__('Assigned opportunities for this contact')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('opportunities.create',['contact',$contact->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{ __('Create') }}" data-title="{{__('Create New Opportunities')}}" class="btn btn-sm btn-primary btn-icon-only ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{__('Account')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Stage')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Assigned User')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Amount')}}</th>
                                        @if(Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities'))
                                            <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($opportunitiess as $opportunities)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('opportunities.show', $opportunities->id) }}" data-ajax-popup="true" data-title="{{__('Opportunities Details')}}" class="action-item text-primary">
                                                    {{ $opportunities->name }}
                                                </a>
                                            </td>
                                            <td class="budget">
                                                {{ !empty($opportunities->account_names)?$opportunities->account_names->name:'-'  }}
                                            </td>

                                            <td>
                                                <span class="badge bg-success p-2 px-3 rounded">
                                                    {{ $opportunities->stages->name}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="budget">{{  !empty($opportunities->assign_user)?$opportunities->assign_user->name:'-' }}</span>
                                            </td>
                                            <td>
                                                <span class="budget">{{\Auth::user()->priceFormat($opportunities->amount)}}</span>
                                            </td>
                                            @if(Gate::check('Show Opportunities') || Gate::check('Edit Opportunities') || Gate::check('Delete Opportunities'))
                                                <td class="text-end">

                                                        @can('Show Opportunities')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md" data-url="{{ route('opportunities.show', $opportunities->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Opportunities Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Opportunities')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('opportunities.edit',$opportunities->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Opportunities')}}"><i class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Opportunities')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['opportunities.destroy', $opportunities->id]]) !!}
                                                                    <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                        <i class="ti ti-trash"></i>
                                                                    </a>
                                                                {!! Form::close() !!}
                                                            </div>

                                                        @endcan

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div id="useradd-4" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('Tasks') }}</h5>
                        <small class="text-muted">{{__('Assigned tasks for this contact')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('task.create') }}" data-ajax-popup="true" title="{{ __('Create') }}" data-bs-toggle="tooltip" data-title="{{__('Create New Task')}}" class="btn btn-sm btn-primary btn-icon-only ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable1">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                        <th scope="col" class="sort" data-sort="budget">{{__('Parent')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Stage')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Date Start')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Assigned User')}}</th>
                                        @if(Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                        <th scope="col" class="text-end">{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>
                                            <a href="#" data-size="md" data-url="{{ route('task.show',$task->id) }}" data-ajax-popup="true" data-title="{{__('Task Details')}}" class="action-item text-primary">
                                                {{ $task->name }}
                                            </a>
                                        </td>
                                        <td class="budget">
                                           {{ $task->parent }}
                                        </td>
                                        <td>
                                            <span class="badge bg-success p-2 px-3 rounded">{{  !empty($task->stages)?$task->stages->name:'' }}</span>
                                        </td>
                                        <td>
                                            <span class="budget">{{\Auth::user()->dateFormat($task->start_date)}}</span>
                                        </td>
                                        <td>
                                            <span class="budget">{{  !empty($task->assign_user)?$task->assign_user->name:'-' }}</span>
                                        </td>
                                        @if(Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                        <td class="text-end">

                                                @can('Show Task')
                                                <div class="action-btn bg-warning ms-2">
                                                <a href="#" data-size="md" data-url="{{ route('task.show',$task->id) }}" data-bs-toggle="tooltip" title="{{__('Details')}}" data-ajax-popup="true" data-title="{{__('Task Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                </div>
                                                @endcan
                                                @can('Edit Task')
                                                <div class="action-btn bg-info ms-2">
                                                <a href="{{ route('task.edit',$task->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Task')}}"><i class="ti ti-edit"></i></a>
                                                </div>
                                                @endcan
                                                @can('Delete Task')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['task.destroy', $task->id]]) !!}
                                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @endcan

                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

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

        $(document).on('change', 'select[name=parent]', function () {
            console.log('h');
            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            console.log(bid);
            $.ajax({
                url: '{{route('task.getparent')}}',
                type: 'POST',
                data: {
                    "parent": bid, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log(data);
                    $('#parent_id').empty();
                    {{--$('#parent_id').append('<option value="">{{__('Select Parent')}}</option>');--}}

                    $.each(data, function (key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>
@endpush
