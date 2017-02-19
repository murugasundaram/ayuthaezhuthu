@extends('layouts.app')
@section('content')
@include('notification')
<div class = 'container'>
    <div class = 'row'>
        <div class = 'col-lg-6 padding0'>
            <h3> <i class="fa fa-users"></i> <span class = 'title'> Tenants </span> </h3>
        </div>
        <div class = 'col-lg-6 padding0'>
            <a href = "{{ url(\App\Tenant::$prefix_route . '/tenants/create') }}" class = 'btn btn-primary pull-right'> Add Tenant </a>
        </div>
    </div>
    <div class = 'row'>
        <div class = 'table-responsive'>
            <table class = 'table table-hover tenants-list'>
                <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Company Name </th>
                    <th> Company Unique Name </th>
                    <th> Email </th>
                    <th> Status </th>
                    <th> Created Time </th>
                    <th> Updated Time </th>
                    <th> Actions </th>
                </tr>
                </thead>
                <tbody>
                @foreach($tenants as $tenant)
                    <tr data-tenant-id = '{{ $tenant->id }}' class = 'cursor'>
                        <td> {{ $tenant->id }} </td>
                        <td> {{ $tenant->name }} </td>
                        <td> {{ $tenant->organisation_name }} </td>
                        <td> {{ $tenant->organisation_unique_name }} </td>
                        <td> {{ $tenant->email }} </td>
                        <td> {{ getTenantStatus($tenant->status) }} </td>
                        <td> {{ $tenant->created_at }} </td>
                        <td> {{ $tenant->updated_at }} </td>
                        <td>
                            <i class = "fa fa-edit edit-a-tenant" data-url = '{{ url(\App\Tenant::$prefix_route . '/tenants') }}/{{ $tenant->id }}/edit'></i>
                            <i class = 'fa fa-trash delete-a-tenant' data-id = '{{ $tenant->id }}'></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($tenant_count == 0)
                <div class = 'alert alert-warning text-center'>
                    No tenants added yet. Click <a href = '{{ url(\App\Tenant::$prefix_route . '/tenants/create') }}'> here </a> to create new tenant
                </div>
            @endif
        </div>
    </div>
</div>

<div>

</div>
@endsection
