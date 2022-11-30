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
        {!! Form::open(array('route'=>'unitresult','method'=>'POST', 'target'=>'_blank')) !!}
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <div class="box-body">
          <div class="form-group">
              <label for="">Property Name</label>
              {!! Form::select('property_id', $properties, null,array('class'=>'form-control','placeholder'=>'Select One','id'=>'pro')) !!}
            </div>
            <div class="form-group">
                <label for="">Level name</label>
                <select name="level_id" id="level" class="form-control">
                    <option value="">Select One</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Select Status</label>
                <select name="status" id="subcat" class="form-control">
                    <option value="">Select One</option>
                    <option value="0">Vaccant</option>
                    <option value="1">Occupied</option>
                </select>
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
          //
          $("#pro").change(function () {
            var url = "{{URL::to('/')}}";
            $('#level').empty();
            $('#level').append('<option value="">Select One</option>');
            var id = $(this).val();
            var url = "{{URL::to('/')}}";
            //alert(id);

            $.ajax({
                type: "GET",
                url: url + '/manager/getlevel/' + id,
                data: {},
                dataType: "JSON",
                success: function (data) {
                  //alert(data);
                    //console.log(data);
                    if (data) {
                        $.each(data, function (key, value) {
                            // alert(key);
                            $('#level').append('<option value="' + value.id + '">' + value.level_name + '</option>');
                        });
                    }

                },
            });

        });
        // end
</script>
@endsection

