@extends('layouts.admin')
@section('page-title')
    {{ __('Support') }}
@endsection
@section('title')
    {{ __('Support') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Support') }}</li>
    <li class="breadcrumb-item">{{ __('Create A ticket') }}</li>
@endsection
@section('action-btn')
    @can('Create LeadSource')
        <div class="action-btn ms-2">
            <a href="{{ route('support.create') }}" data-size="md" data-bs-toggle="tooltip" data-title="{{ __('Create A New Ticket') }}" title="{{ __('Create') }}"
                class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    @endcan
@endsection
@section('filter')
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
                                        <th scope="col" class="sort" data-sort="name">{{ __('Ticket Type') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Ticket Source') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Suport Mode') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Company Name') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Person Name') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Product Name') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Assigned To') }}</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __('Status') }}</th>
                                        @if (Gate::check('Edit LeadSource') || Gate::check('Delete LeadSource'))
                                            <th class="text-end">{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supports as $support)
                                        <tr>
                                            <td class="sorting_1">{{ $support->ticket_type }}</td>
                                            <td class="sorting_1">{{ $support->ticket_source }}</td>
                                            <td class="sorting_1">{{ $support->support_mode }}</td>
                                            <td class="sorting_1">{{ $support->lead->company_name }}</td>
                                            <td class="sorting_1">{{ $support->poc->name }}</td>
                                            <td class="sorting_1">{{ $support->product->name }}</td>
                                            <td class="sorting_1">{{ $support->Owner->name }}</td>
                                            <td class="sorting_1">{{ $support->status }}</td>
                                            @if (Gate::check('Edit LeadSource') || Gate::check('Delete LeadSource'))
                                                <td class="action text-end">
                                                    @can('Edit LeadSource')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('support.edit', $support->id) }}" data-size="md" data-bs-toggle="tooltip"
                                                                data-title="{{ __('Edit Support') }}"
                                                                title="{{ __('Edit') }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                <i class="ti ti-edit"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('Delete LeadSource')
                                                        <div class="action-btn bg-danger ms-2 float-end">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['support.destroy', $support->id]]) !!}
                                                            <a href="#!" class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                data-bs-toggle="tooltip" title='Delete'>
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
    </div>
@endsection
