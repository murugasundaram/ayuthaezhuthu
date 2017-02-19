@extends('layouts.app')
@section('content')
@include('notification')
    <div class = 'container'>
        @if(!empty($id))
            <form name = 'edit_tenant' id = 'edit_tenant' action = '{{ url(\App\Tenant::$prefix_route . '/tenants') }}/{{ $id }}' method = 'POST'>
                {{ method_field('PUT') }}
        @else
            <form name = 'edit_tenant' id = 'edit_tenant' action = '{{ url(\App\Tenant::$prefix_route . '/tenants/store') }}' method = 'POST'>
        @endif

        {{ csrf_field() }}

        <div class = 'row'>
            <div class = 'col-lg-6 padding0'>
                <h3> <i class="fa fa-users"></i> Tenants </h3>
            </div>
            <div class = 'col-lg-6 padding0'>
                @if(!empty($id))
                    <button type = 'submit' class = 'btn btn-primary pull-right marginl10 process-tenant-submission'> Update </button>
                @else
                    <button type = 'submit' class = 'btn btn-primary pull-right marginl10 process-tenant-submission'> Add </button>
                @endif
                <a href = '{{ url(\App\Tenant::$prefix_route . '/tenants') }}' class = 'btn btn-default pull-right'> Cancel </a>
            </div>
        </div>
        <div class = 'row'>
                <div class = 'form-group'>
                    <label for = "name"> Name </label>
                    <input type = 'text' name = 'name' class = 'form-control' required value = '{{ $tenant->name }}'>
                </div>
                <div class = 'form-group'>
                    <label for = 'company_name'> Company Name </label>
                    <input type = 'text' name = 'organisation_name' class = 'form-control' required value = '{{ $tenant->organisation_name }}'>
                </div>
                @if(empty($id))
                <div class = 'form-group'>
                    <label for = 'company_name'> Company's Unique Name </label>
                    <input type = 'text' name = 'organisation_unique_name' class = 'form-control' required value = '{{ $tenant->organisation_unique_name }}'>
                </div>
                @endif
                <div class = 'form-group'>
                    <label for = 'email'> Email </label>
                    <input type = 'email' name = 'email' class = 'form-control' required value = '{{ $tenant->email }}'>
                </div>
                <div class = 'form-group'>
                    <div class = 'col-lg-offset-6'>
                        @if(!empty($id))
                            <button type = 'submit' class = 'btn btn-primary pull-right marginl10 process-tenant-submission'> Update </button>
                        @else
                            <button type = 'submit' class = 'btn btn-primary pull-right marginl10 process-tenant-submission'> Add </button>
                        @endif
                        <a href = '{{ url(\App\Tenant::$prefix_route . '/tenants') }}' class = 'btn btn-default pull-right'> Cancel </a>
                    </div>
                </div>
        </div>
        </form>
    </div>
@endsection
