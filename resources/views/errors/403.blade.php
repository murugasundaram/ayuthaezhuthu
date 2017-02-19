@extends('layouts.app')
@section('content')
    <div class = 'container-fluid'>
        <div class = 'alert alert-danger text-center'> <i class = 'fa fa-warning'></i> {{ $exception->getMessage() }} Click <a class = 'pointer' onclick = "window.history.back();">here</a> to go back </div>
    </div>
@endsection

