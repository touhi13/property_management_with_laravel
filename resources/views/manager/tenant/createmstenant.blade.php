@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    @include('partial.formerror')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Tenant</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'tenant.store','method'=>'POST')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="full_name">
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
                    <label for="">Phone</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="phone">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="email">
                </div>
                <div class="form-group">
                    <label for="">Get in Date</label>
                    <input type="date" class="form-control" id="" placeholder="Property Title" name="get_in_date">
                </div>
                <div class="form-group">
                    <label for="">Property</label>
                    {!! Form::select('property_id', $allpro, null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select name="level_id" id="level" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Mess</label>
                    <select name="mess_id" id="mess" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Seat No</label>
                    <select name="seat_id" id="seat" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Security Money</label>
                    <input type="text" class="form-control" id="" placeholder="Property Title" name="security_money">
                </div>
                <div class="form-group">
                    <label for="">Agreement Document</label>
                    <input type="file" name="doc" id="">
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
        $("#level").change(function () {
            var url = "{{URL::to('/')}}";
            $('#place').empty();
            $('#place').append('<option value="">Select One</option>');
            var levelid = $(this).val();
            console.log(levelid);
            var url = "{{URL::to('/')}}";

            $.ajax({
                type: "GET",
                url: url + '/manager/getplace/' + levelid,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                            // alert(key);
                            $('#place').append('<option value="' + value.id + '">' +
                                value.place_no + '</option>');
                        });
                    }

                },
            });

        });
        $("#pro").change(function () {
            var url = "{{URL::to('/')}}";
            $('#level').empty();
            $('#level').append('<option value="">Select One</option>');
            var proid = $(this).val();
            var url = "{{URL::to('/')}}";

            $.ajax({
                type: "GET",
                url: url + '/manager/getlevel/' + proid,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                            // alert(key);
                            $('#level').append('<option value="' + value.id + '">' +
                                value.level_name + '</option>');
                        });
                    }

                },
            });

        });
        //category end
        $("#level").change(function () {
            $('#mess').empty();
            $('#mess').append('<option value="">Select One</option>');
            var levelId = $(this).val();
            var url = "{{URL::to('/')}}";

            $.ajax({
                type: "GET",
                url: url + '/manager/getmess/' + levelId,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                           //alert(key);
                            $('#mess').append('<option value="' + value.id + '">' +
                                value.mess_name + '</option>');
                        });
                    }

                },
            });

        });


        $("#mess").change(function () {
            $('#seat').empty();
            $('#seat').append('<option value="">Select One</option>');
            var messId = $(this).val();
            var url = "{{URL::to('/')}}";

            $.ajax({
                type: "GET",
                url: url + '/manager/getseat/' + messId,
                data: {},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                           //alert(key);
                            $('#seat').append('<option value="' + value.id + '">' +
                                value.seat_no + '</option>');
                        });
                    }

                },
            });

        });
    });

</script>
@endsection
