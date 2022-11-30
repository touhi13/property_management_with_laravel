@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($employee, ['method' => 'PATCH','route' =>
            ['employee.update',$employee->id]])!!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Full Name</label>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' =>
                    'form-control')) !!}
                </div>
                <div class="form-group">
                    <label for="">Position Name</label>
                    {!! Form::text('position_name', null, array('placeholder' => 'Name','class' =>
                    'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('gender', $genders, null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
                </div>
                <div class="form-group">
                    <label for="">National Id</label>
                    {!! Form::text('national_id', null, array('placeholder' => 'Name','class' =>
                    'form-control')) !!}
                </div>
                <div class="form-group">
                    <label for="">Upload NID</label>
                    <input type="file" name="doc" id="">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    {!! Form::text('phone', null, array('placeholder' => 'Name','class' =>
                    'form-control')) !!}
                </div>
                <div class="form-group">
                    <label for="">Permanent Address</label>
                    {!! Form::text('permanent_address', null, array('placeholder' => 'Name','class' =>
                    'form-control')) !!}
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="photo" id="">
                </div>
                <div class="form-group">
                    <label for="">Property</label>
                    {!! Form::select('property_id', $properties, null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Salary</label>
                    {!! Form::text('salary', null, array('placeholder' => 'Name','class' =>
                    'form-control')) !!}
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
