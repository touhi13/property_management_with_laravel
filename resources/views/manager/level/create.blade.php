@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    @include('partial.formerror')
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Level</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(array('route'=>'level.store','method'=>'POST')) !!}
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <div class="box-body">
            <div class="form-group">
              <label for="">Property</label>
              {!! Form::select('property_id', $properties, null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
            </div>

            <div class="form-group">
                <label for="">Level Name</label>
                <input type="text" class="form-control" id="" placeholder="Property Title" name="name">
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