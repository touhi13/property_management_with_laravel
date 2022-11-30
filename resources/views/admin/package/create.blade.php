@extends('layouts.admin')
@section('css')
<style>
    textarea {
        resize: none;
    }
</style>
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    @include('partial.formerror')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Package</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => 'package.store','method'=>'POST')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Package Name</label>
                    {!! Form::text('name', null, array('placeholder' => 'Package Name',
                    'class' => 'form-control')) !!}
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('description', null, array('placeholder' => 'Description',
                    'class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    <label for="">Duration</label>
                    {!! Form::text('duration', null, array('placeholder' => 'Duration',
                    'class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    {!! Form::text('price', null, array('placeholder' => 'Price',
                    'class' => 'form-control')) !!}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
