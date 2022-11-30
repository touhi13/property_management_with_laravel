@extends('layouts.manager')
@section('content')
<style>

p{
    margin-top: 30%
}
</style>
<div class="row">
    <!-- left column -->
    <div class="col-md-6 text-center">
        <!-- general form elements -->
    <a href="{{url('manager/createmstenant')}}" class="btn btn-danger btn-lg center-block" style="width: 550px; margin-top: 40%;">Mess</a>

    </div>
    <div class="col-md-6 text-center">
        <!-- general form elements -->
<a href="{{url('manager/tenant/create')}}" class="btn btn-warning btn-lg center-block" style="width: 550px; margin-top: 40%;">Unit</a>
    </div>
</div>
@endsection
