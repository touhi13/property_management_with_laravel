@extends('layouts.manager')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Level</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($level, ['method' => 'PATCH','route' =>
        ['level.update',$level->id]])!!}
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <div class="box-body">
            <div class="form-group">
              <label for="">Property</label>
              {!! Form::select('property_id', $properties, null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
            </div>

            <div class="form-group">
                <label for="">Level Name</label>
                {!! Form::text('level_name', null, array('placeholder' => 'Name','class' =>
                'form-control')) !!}
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