@extends('layouts.manager')
@section('content')

<div class="row d-flex justify-content-center" >

        @forelse ($properties as $property)
        <a href="{{url('manager/property/show/'.$property->id)}}">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/pro_img/'.$property->image)}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$property->property_title}}</h3>

              <p class="text-muted text-center">{{$property->address}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Total Levels</b> <a class="pull-right">{{$property->levelCount}}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Units</b> <a class="pull-right">{{$property->placeCount}}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Tenants</b> <a class="pull-right">{{$property->tenantCount}}</a>
                </li>
              </ul>
              <a href="{{url('manager/property/'.$property->id.'/edit')}}" class="btn btn-warning"><b>Edit</b></a>
              {!! Form::open(['method' => 'DELETE','route' => ['property.destroy',
              $property->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
              {!! Form::button('Delete',['type' => 'submit','class' => 'btn btn-danger'])!!}
              {!! Form::close() !!}
              <a href="{{url('manager/place/create',$property->id)}}" class="btn btn-success"><b>Add Unit</b></a>
              {{-- <a href="{{url('manager/level/create')}}" class="btn btn-warning"><b>Add Unit</b></a> --}}
            </div>
            <!-- /.box-body -->
          </div>
        </a>
          <!-- /.box -->
          
        </div>
        @empty
        <a href="{{url('manager/property/create')}}" class="btn btn-primary pull-right">Create New Property</a>
        <p class="h1 text-center">Empty Property</p>

        


        @endforelse

    </div>
    {!! $properties->links() !!}
    

@endsection
@section('script')
@include('partial.message')
@endsection