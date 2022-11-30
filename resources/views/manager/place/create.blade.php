@extends('layouts.manager')

@section('css')

<style>
textarea { resize:none; }
</style>



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
        {!! Form::open(array('route'=>'storeplace','method'=>'POST')) !!}
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
        <input type="hidden" value="{{$proid}}" name="proid" />
          <div class="box-body">
            <div class="form-group">
              <label for="">Category</label>
              {!! Form::select('category_id', $allcat, null,array('class'=>'form-control','placeholder'=>'Select One','id'=>'cat')) !!}
            </div>
            <div class="form-group">
              <label for="">Level</label>
              {!! Form::select('level_id', $levels, null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
            </div>
            <div class="form-group">
                <label for="">Unit No</label>
                <input type="text" class="form-control" id="" placeholder="Property Title" name="place_no">
            </div>
            <div class="form-group">
                <label for="">Unit Type</label>
                <select name="subcategory_id" id="subcat" class="form-control">
                    <option value="">Select One</option>
                </select>
            </div>

            <div class="form-group">
              <label for="">Size</label>
              <input type="text" class="form-control" id="" placeholder="Property Title" name="size">
            </div>
            <!-- textarea -->
            <div class="form-group">
              <label>Features</label>
              <textarea class="form-control" name="features" rows="3" placeholder="Enter ..."></textarea>
            </div>

            <div class="form-group">
                <label for="">Rent</label>
                <input type="text" class="form-control" id="" placeholder="Property Title" name="rent">
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
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    //
    $("#cat").change(function(){
    var url = "{{URL::to('/')}}";
    $('#subcat').empty();
    var catid = $(this).val();
    var url = "{{URL::to('/')}}";

    $.ajax({
        type: "GET",
        url: url + '/manager/getsubcategory/'+catid,
        data:{},
        dataType: "JSON",
        success:function(data) {
            console.log(data);
                if(data){
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#subcat').append('<option value="'+value.id+'">' + value.name + '</option>');
                    });
                }

            },
    });

});
//category end

});
</script>
@endsection

@section('script')
@if(Session::has('message'))
<script>
    swal('Success!', '{{ Session::get('message') }}', 'success');
</script>
@endif

@endsection