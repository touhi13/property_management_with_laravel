@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
            @include('partial.formerror')
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'employee.store','method'=>'POST')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="full_name">
                </div>
                <div class="form-group">
                    <label for="">Position Name</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="position_name">
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                    <select name="gender" id="" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">National Id</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="national_id">
                </div>
                <div class="form-group">
                    <label for="">Upload NID</label>
                    <input type="file" name="doc" id="">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="phone">
                </div>
                <div class="form-group">
                    <label for="">Permanent Address</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="permanent_address">
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="photo" id="">
                </div>
                <div class="form-group">
                    <label for="">Property</label>
                    {!! Form::select('property_id', $allpro, null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Salary</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="salary">
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
