@extends('layouts.manager')
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
            {!! Form::open(array('route'=>'salaryresult','method'=>'POST', 'target'=>'_blank')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Employee Name</label>
                    {!! Form::select('employee_id', $employees,
                    null,array('class'=>'form-control','placeholder'=>'Select One','id'=>'cat')) !!}
                </div>
                <div class="form-group">
                    <label for="">Year</label>
                    {!! Form::selectYear('year', 2015, 2025, null, array('class'=>'form-control','placeholder'=>'Select
                    One', 'id'=>'year')) !!}
                </div>


                <div class="form-group">
                    <label for="">Month</label>
                    {!! Form::selectMonth('month',null, array('class'=>'form-control','placeholder'=>'Select One',
                    'id'=>'month','disabled')) !!}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Get Report</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#year").change(function () {
            $("#month").removeAttr("disabled")
        })
    });

</script>
@endsection
