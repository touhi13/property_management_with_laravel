@extends('layouts.admin')

@section('content')
<div class="row">
    @include('partial.formerror')
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Banner</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route'=>'storebanner','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <div class="box-body">

                <div class="form-group">
                    <label for="">Image</label>
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
{{-- card --}}
<div class="row d-flex justify-content-center">
    @foreach ($banner as $item)
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class=" img-responsive " src="{{asset('storage/banner/'.$item->image)}}"
                    alt="User profile picture">
                    {!! Form::open(['method' => 'DELETE','route' => ['property.destroy',
                    $item->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
                    {!! Form::button('Delete',['type' => 'submit','class' => 'btn btn-danger'])!!}
                    {!! Form::close() !!}
                    <input type="radio" name="" id="">

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    @endforeach
</div>
@endsection
