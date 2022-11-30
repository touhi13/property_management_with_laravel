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
                <h3 class="box-title">Edit Property</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($property, ['method' => 'PATCH','route' =>
            ['property.update',$property->id],'enctype'=>'multipart/form-data'])!!}
            {{-- {!! Form::open(array('route'=>'property.update',$property->id,'method'=>'POST', 'enctype'=>'multipart/form-data')) !!} --}}
            {{-- <input type="hidden" value="{{csrf_token()}}" name="_token" /> --}}
            <div class="box-body">
                <div class="form-group">
                    <label for="">Property Title</label>
                    {!! Form::text('property_title', null, array('placeholder' => 'Property Title','class' =>
                    'form-control')) !!}
                    {{-- <input type="text" class="form-control" id="" placeholder="Property Title" name="property_title"> --}}
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('description', null, array('placeholder' => 'Enter ...','class' =>
                    'form-control')) !!}
                    {{-- <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea> --}}
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                    {{-- <input type="text" name="address" class="form-control" id="" placeholder="Address"> --}}
                </div>
                {{-- <div class="form-group">
                    @if ("{{asset('storage/pro_img/'.$property->image)}}")
                <img src="{{asset('storage/pro_img/'.$property->image)}}">
                @else
                <p>No image found</p>
                @endif
                <label for="">File input</label>
                <input type="file" name="image" value="{{ $property->images }}" />
            </div> --}}
            <div class="form-group">
                {!! Form::file('image', null, array('class' => 'form-control')) !!}
                {{-- <input type="file" name="image" id=""> --}}
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@endsection
