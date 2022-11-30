@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    @include('partial.formerror')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Give Salary</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'givesalary','method'=>'POST')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Property</label>
                    {!! Form::select('property_id', $properties,
                    null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Employee Name</label>
                    <select name="employee_id" id="employee" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" class="form-control" id="" placeholder="salary amount" name="give_salary">
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
<script>
    $(document).ready(function () {
        //header for csrf-token is must in laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //
        $("#pro").change(function () {
            var url = "{{URL::to('/')}}";
            $('#employee').empty();
            $('#employee').append('<option value="">Select One</option>');
            var proid = $(this).val();
            var url = "{{URL::to('/')}}";

            $.ajax({
                type: "GET",
                url: url + '/manager/getemployee/' + proid,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                            // alert(key);
                            $('#employee').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }

                },
            });

        });
        //category end
    });
</script>
@endsection
