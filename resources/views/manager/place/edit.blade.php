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
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Unit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->        
            {!! Form::model($unit, ['method' => 'PATCH','route' =>
        ['place.update',$unit->id],'enctype'=>'multipart/form-data'])!!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">
                <div class="form-group">
                    <label for="">Category</label>
                    {!! Form::select('category_id', $categories, null,array('class'=>'form-control','placeholder'=>'Select
                    One','id'=>'cat')) !!}
                </div>
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
                    <label for="">Unit No</label>
                    {!! Form::text('place_no', null, array('placeholder' => 'Unit No','class' =>
                    'form-control')) !!}
                </div>
                <div class="form-group">
                    <label for="">Unit Type</label>
                    {!! Form::select('subcategory_id', $unitTypes,
                    null,array('class'=>'form-control','placeholder'=>'Select One')) !!}
                </div>

                <div class="form-group">
                    <label for="">Size</label>
                    {!! Form::text('size', null, array('placeholder' => 'Size','class' =>
                    'form-control')) !!}
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Features</label>
                    {!! Form::textarea('features', null, array('placeholder' => 'Enter ...','class' =>
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
