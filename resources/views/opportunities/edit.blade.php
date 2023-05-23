@extends('layouts.admin')
@section('page-title')
    {{__('Opportunities Edit')}}
@endsection
@section('title')
    {{__('Edit Opportunities')}}  {{ '('. $opportunities->name .')' }}
@endsection
@section('action-btn')
    <div class="btn-group" role="group">
        @if(!empty($previous))
            <div class="action-btn  ms-2">
                <a href="{{ route('opportunities.edit',$previous) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        @else
            <div class="action-btn ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Previous')}}">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        @endif
        @if(!empty($next))
            <div class="action-btn ms-2">
                <a href="{{ route('opportunities.edit',$next) }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{__('Next')}}">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        @else
            <div class="action-btn ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="{{__('Next')}}">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        @endif
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('opportunities.index')}}">{{__('Opportunities')}}</a></li>
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
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0">{{__('Documents')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-4" class="list-group-item list-group-item-action border-0">{{__('Tasks')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div id="useradd-1" class="card">
                    {{Form::model($opportunities,array('route' => array('opportunities.update', $opportunities->id), 'method' => 'PUT')) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{__('Edit about your opportunities information')}}</small>
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
                                    {!! Form::select('account', $account_name, null,array('class' => 'form-control ')) !!}
                                    </div>
                                    @error('account')
                                    <span class="invalid-account" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('contact',__('Contact'),['class'=>'form-label']) }}
                                        {!! Form::select('contact', $contact, null,array('class' => 'form-control ')) !!}
                                        @error('contacts')
                                        <span class="invalid-contacts" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    {{Form::label('campaign',__('Campaign'),['class'=>'form-label']) }}
                                    {!! Form::select('campaign', $campaign_id, null,array('class' => 'form-control ')) !!}
                                    </div>
                                    @error('campaign_id')
                                    <span class="invalid-campaign_id" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    {{Form::label('stage',__('Stage'),['class'=>'form-label']) }}
                                    {!! Form::select('stage', $stages, null,array('class' => 'form-control ','required'=>'required')) !!}
                                    </div>
                                    @error('stage')
                                    <span class="invalid-stage" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('amount',__('Amount'),['class'=>'form-label']) }}
                                        {{Form::number('amount',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
                                        @error('amount')
                                        <span class="invalid-amount" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('probability',__('Probability'),['class'=>'form-label']) }}
                                        {{Form::number('probability',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
                                        @error('probability')
                                        <span class="invalid-probability" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('close_date',__('Close Date'),['class'=>'form-label']) }}
                                        {{Form::date('close_date',date('Y-m-d'),array('class'=>'form-control datepicker','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
                                        @error('close_date')
                                        <span class="invalid-close_date" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        {{Form::label('lead_source',__('Lead Source'),['class'=>'form-label']) }}
                                        {!! Form::select('lead_source', $lead_source, null,array('class' => 'form-control ','required'=>'required')) !!}
                                        @error('lead_source')
                                        <span class="invalid-lead_source" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    {{Form::label('user',__(' Assigned User'),['class'=>'form-label']) }}
                                    {!! Form::select('user', $user,  $opportunities->user_id,array('class' => 'form-control ')) !!}
                                    </div>
                                    @error('user')
                                    <span class="invalid-user" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {{Form::label('description',__('Description'),['class'=>'form-label']) }}
                                        {!! Form::textarea('description',null,array('class' =>'form-control ','rows'=>3)) !!}
                                        @error('description')
                                        <span class="invalid-description" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
                    {{Form::open(array('route' => array('streamstore',['opportunities',$opportunities->name,$opportunities->id]), 'method' => 'post','enctype'=>'multipart/form-data')) }}
                    <div class="card-header">
                        <h5>{{__('Stream')}}</h5>
                        <small class="text-muted">{{__('Add stream comment')}}</small>
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
                                <input type="hidden" name="log_type" value="opportunities comment">

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
                           @if($remark->data_id == $opportunities->id)
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
                                <h5>{{ __('Documents') }}</h5>
                                <small class="text-muted">{{__('Assigned document for this opportunities')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('document.create',['opportunities',$opportunities->id]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Documents')}}"title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon-only   ">
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
                                        <th scope="col" class="sort" data-sort="budget">{{__('File')}}</th>
                                        <th scope="col" class="sort" data-sort="status">{{__('Status')}}</th>
                                        <th scope="col" class="sort" data-sort="completion">{{__('Created At')}}</th>
                                        <th scope="col" class="text-end">{{__('Action')}}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td>
                                                <a href="#" data-size="md" data-url="{{ route('document.show',$document->id) }}" data-ajax-popup="true" data-title="{{__('Document Details')}}" class="action-item text-primary">
                                                    {{ $document->name }}</a>
                                            </td>
                                            <td class="budget">
                                                @if(!empty($document->attachment))
                                                    <a href="{{ asset(Storage::url('upload/profile')).'/'.$document->attachment }}" download=""><i class="ti ti-download"></i></a>
                                                @else
                                                    <span>
                                                        {{ __('No File') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($document->status == 0)
                                                    <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @elseif($document->status == 1)
                                                    <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @elseif($document->status == 2)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @elseif($document->status == 3)
                                                    <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Document::$status[$document->status]) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="budget">{{\Auth::user()->dateFormat($document->created_at)}}</span>
                                            </td>
                                            @if(Gate::check('Show Document') || Gate::check('Edit Document') || Gate::check('Delete Document'))
                                            <td class="text-end">

                                                    @can('Show Document')
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" data-size="md" data-url="{{ route('document.show',$document->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Document Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('Edit Document')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('document.edit',$document->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Document Edit')}}"><i class="ti ti-edit"></i></a>
                                                        </div>
                                                    @endcan
                                                    @can('Delete Document')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $document->id]]) !!}
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
                                 <small class="text-muted">{{__('Assigned Tasks for this opportunities')}}</small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a href="#" data-size="lg" data-url="{{ route('task.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}"data-title="{{__('Create New Task')}}" class="btn btn-sm btn-primary btn-icon-only ">
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
                                            <th scope="col">{{__('Action')}}</th>
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
                                                <span class="budget">{{  !empty($task->stages)?$task->stages->name:'' }}</span>
                                            </td>
                                            <td>
                                                <span class="budget">{{\Auth::user()->dateFormat($task->start_date)}}</span>
                                            </td>
                                            <td>
                                                <span class="budget">{{  !empty($task->assign_user)?$task->assign_user->name:'-' }}</span>
                                            </td>
                                            @if(Gate::check('Show Task') || Gate::check('Edit Task') || Gate::check('Delete Task'))
                                            <td>
                                                <div class="d-flex">
                                                    @can('Show Task')
                                                    <div class="action-btn bg-warning ms-2">
                                                    <a href="#" data-size="md" data-url="{{ route('task.show',$task->id) }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Details')}}" data-title="{{__('Task Details')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
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
                                                </div>
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
