
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
    <!-- left column -->
    @include('partial.formerror')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Mess</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'mess.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Property Name</label>
                    {!! Form::select('property_id', $properties,
                    null,array('class'=>'form-control','placeholder'=>'Select One','id'=>'pro')) !!}
                </div>
                <div class="form-group">
                    <label for="">Level Name</label>
                    <select name="level_id" id="level" class="form-control">
                        <option value="">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Mess Name</label>
                    <input type="text" class="form-control" id="" placeholder="Mess Name" name="mess_name">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
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
    });
</script>
@endsection