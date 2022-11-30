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
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => 'category.store','method'=>'POST')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Name</label>
                    {!! Form::text('name', null, array('placeholder' => 'Name',
                    'class' => 'form-control')) !!}
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('description', null, array('placeholder' => 'description',
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
