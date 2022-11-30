@extends('layouts.manager')
@section('css')
<style>
    textarea {
        resize: none;
    }
</style>
@endsection
@section('content')
<div class="row">
        @include('partial.formerror')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Property</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'property.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Property Title</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="property_title">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control" id="" placeholder="Address">
                </div>

                <div class="form-group">
                    <label for="">File input</label>
                    <input type="file" name="image" id="">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('script')
@include('partial.message')
@endsection
