@extends('layouts.app')
@section('content')
@include('notification')
<div class = 'container'>
    <div class = 'row'>
        <div class = 'col-lg-6 padding0'>
            <h3> <i class="fa fa-user md-30"></i> <span class = 'title'> Tenant Details </span> </h3>
        </div>
        <div class = 'col-lg-6 padding0'>
            <a href = "{{ url(\App\Tenant::$prefix_route . '/tenants') }}/{{ $id }}/edit" class = 'btn btn-primary pull-right marginl10'> Edit Tenant </a>
            <a href = "#" class = 'btn btn-info pull-right marginl10' data-toggle="modal" data-target="#add-user-modal" > <i class = 'fa fa-plus'> </i> Create Admin to this Tenant </a>
            <div class="dropdown pull-right marginl10">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Status
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @foreach($tenant_statuses as $status_key => $status_value)
                        <li> <a href = '#' data-toggle="modal" data-tenant-id = "{{ $id }}" data-url = "{{ url(\App\Tenant::$prefix_route . '/tenants/status/html') }}" data-status-id = "{{ $status_key }}" data-current-status-id = '{{ $tenant->status }}' class = 'change-tenant-status' data-target="#add-comment-modal"> {{ $status_value['name'] }} </a> </li>
                    @endforeach
                </ul>
            </div>
            <a href = "{{ url(\App\Tenant::$prefix_route . '/tenants') }}" class = 'btn btn-default pull-right'> <i class="fa fa-arrow-left"></i> Back to Tenants </a>
        </div>
    </div>
    <hr class = 'row'>
    <div class = 'form-horizontal'>
        <div class = 'form-group'>
            <label class = 'col-lg-2 control-label'> Name </label>
            <div class = 'col-lg-5 show_value'> {{ $tenant->name }} </div>
        </div>
        <div class = 'form-group'>
            <label class = 'col-lg-2 control-label'> Company Name </label>
            <div class = 'col-lg-5 show_value'> {{ $tenant->organisation_name }} </div>
        </div>
        <div class = 'form-group'>
            <label class = 'col-lg-2 control-label'> Company's Unique Name </label>
            <div class = 'col-lg-5 show_value'> {{ $tenant->organisation_unique_name }} </div>
        </div>
        <div class = 'form-group'>
            <label class = 'col-lg-2 control-label'> Email </label>
            <div class = 'col-lg-5 show_value'> {{ $tenant->email }} </div>
        </div>
        <div class = 'form-group'>
            <label class = 'col-lg-2 control-label'> Status </label>
            <div class = 'col-lg-5 show_value'> {{ getTenantStatus($tenant->status) }} </div>
        </div>
    </div>
    <div class = 'row'> <h4> Updates </h4> </div> <hr class = 'row'>
    <div class = 'row'>
        @foreach($comments as $comment)
            <div class = 'col-lg-12 comment-content'>
                <div class = 'row'> Instance <p class = 'comment-bg bg-{{ getClassForTenantStatus($comment->status) }}'>{{ getTenantStatus($comment->status) }}</p> by {{ getUserFullName($comment->added_by) }} at {{ $comment->created_at }}
                </div>
                <div class = 'row'>
                    @if($comment->comment_description)
                        <i class="fa fa-comment"></i> <i class = 'tenant-user-comment'> {{ $comment->comment_description }} </i>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id = 'add-comment-modal'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Are you sure you want to change the status of this tenant ? </h4>
            </div>
            <form name = 'add-comment' action = '{{ url(\App\Tenant::$prefix_route . '/tenants/status') }}' method = 'POST' class = 'form-horizontal'>
            <div class="modal-body">
                {{ csrf_field() }}
                <div id = 'add-comment-container'> </div>
                <div id = 'modal-loading' class = 'text-center'>
                    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i> <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"> Change </button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id = 'add-user-modal'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Create a Admin User </h4>
            </div>
            <form name = 'add-tenant-user' id = 'add-tenant-user' action = '{{ url(\App\Tenant::$prefix_route . '/tenants/add_user') }}' method = 'POST' class = 'form-horizontal' role = 'form'>
                <div class="modal-body">
                    <input type = 'hidden' value = '{{ $id }}' name = 'organisation_id' id = 'organisation_id'>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-lg-3 control-label"> Name </label>
                        <div class = 'col-lg-8'>
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-3 control-label">Email Address</label>
                        <div class = 'col-lg-8'>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-3 control-label">Password</label>
                        <div class = 'col-lg-8'>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-lg-3 control-label">Confirm Password</label>
                        <div class = 'col-lg-8'>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required >
                        </div>
                    </div>

                    <div class = 'form-group'>
                        <label for = "is_admin" class = 'col-lg-3 control-label'> Is Admin </label>
                        <div class = 'col-lg-8'>
                            <input type = 'checkbox' name = 'is_admin' id = 'is_admin' checked>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary process-user-submission"> Create </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection