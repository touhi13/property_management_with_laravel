@extends('layouts.manager')
@section('content')
<div class="row">
        @include('partial.formerror')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Rental Report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'rentresult','method'=>'POST', 'target'=>'_blank')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Propety Name</label>
                    {!! Form::select('property_id', $properties,
                    null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Level name</label>
                    <select name="level_id" id="level_id" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tenant name</label>
                    <select name="tenant_id" id="tenant_id" class="form-control">
                        <option value="">Select One</option>
                    </select>
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
        //header for csrf-token is must in laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //
        $("#pro").change(function () {
            var url = "{{URL::to('/')}}";
            $('#level_id').empty();
            $('#level_id').append('<option value="">Select One</option>');
            var id = $(this).val();
            var url = "{{URL::to('/')}}";

            $.ajax({
                type: "GET",
                url: url + '/manager/getlevel/' + id,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    //console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                            // alert(key);
                            $('#level_id').append('<option value="' + value.id +
                                '">' + value.level_name + '</option>');
                        });
                    }

                },
            });

        });
        // end

        $("#level_id").change(function () {
            var url = "{{URL::to('/')}}";
            $('#tenant_id').empty();
            $('#tenant_id').append('<option value="">Select One</option>');
            var id = $(this).val();
            var url = "{{URL::to('/')}}";
            //alert(id);

            $.ajax({
                type: "GET",
                url: url + '/manager/gettenant/' + id,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    //alert(data);
                    if (data) {
                        $.each(data, function (key, value) {
                            // alert(key);
                            $('#tenant_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }

                },
            });

        });
        // end

        $("#year").change(function () {
            $("#month").removeAttr("disabled")

        })
    });

</script>
@endsection
