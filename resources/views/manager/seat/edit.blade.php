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
                <h3 class="box-title">Edit Seat</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($seat, ['method' => 'PATCH','route' =>
            ['seat.update',$seat->id],'enctype'=>'multipart/form-data'])!!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Property Name</label>
                    {!! Form::select('property_id', $properties,
                    null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
                </div>
                <div class="form-group">
                    <label for="">Level Name</label>
                    {!! Form::select('level_id', $levels,
                    null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
                </div>
                <div class="form-group">
                    <label for="">Mess Name</label>
                    {!! Form::select('mess_id', $messes,
                    null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
                </div>
                <div class="form-group">
                    <label for="">Seat No</label>
                    {!! Form::text('seat_no', null, array('placeholder' => 'Seat No','class' =>
                    'form-control')) !!}
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('description', null, array('placeholder' => 'Enter ...','class' =>
                    'form-control','rows'=>'3')) !!}
                </div>
                <div class="form-group">
                    <label for="">Rent</label>
                    {!! Form::text('rent', null, array('placeholder' => 'Rent','class' =>
                    'form-control')) !!}
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
            $('#level').empty();
            $('#level').append('<option value="">Select One</option>');
            var proid = $(this).val();

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
    });

</script>
@endsection
