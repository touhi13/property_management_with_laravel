@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Tenant</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($tenant, ['method' => 'PATCH','route' =>
            ['tenant.update',$tenant->id],'enctype'=>'multipart/form-data'])!!}
            <div class="box-body">
                <div class="form-group">
                    <label for="">Full Name</label>
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                    {{-- <input type="text" class="form-control" id="" placeholder="Property Title" name="full_name"> --}}
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
                    {!! Form::text('national_id', null, array('class' => 'form-control')) !!}
                    {{-- <input type="text" class="form-control" id="" placeholder="Property Title" name="national_id"> --}}
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    {!! Form::text('phone', null, array('class' => 'form-control')) !!}
                    {{-- <input type="text" class="form-control" id="" placeholder="Property Title" name="phone"> --}}
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    {!! Form::text('email', null, array('class' => 'form-control')) !!}
                    {{-- <input type="text" class="form-control" id="" placeholder="Property Title" name="email"> --}}
                </div>
                <div class="form-group">
                    <label for="">Get in Date</label>
                    {!! Form::date('get_in_date', null, array('class' => 'form-control')) !!}
                    {{-- <input type="date" class="form-control" id="" placeholder="Property Title" name="get_in_date"> --}}
                </div>
                <div class="form-group">
                    <label for="">Property</label>
                    {!! Form::select('property_id', $allpro, null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    {{-- {!! Form::select('level_id', null,array('class'=>'form-control','id'=>'level')) !!} --}}
                    <select name="level_id" id="level" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Place</label>
                    <select name="place_id" id="place" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Security Money</label>
                    {!! Form::text('security_money', null, array('class' => 'form-control')) !!}
                    {{-- <input type="text" class="form-control" id="" placeholder="Property Title" name="security_money"> --}}
                </div>
                <div class="form-group">
                    <label for="">Agreement Document</label>
                    {!! Form::file('doc', null, array('class' => 'form-control')) !!}
                    {{-- <input type="file" name="doc" id=""> --}}
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
    });

</script>
@endsection
