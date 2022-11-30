@extends('layouts.manager')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        @foreach ($places as $p)
        <h3 class="box-title">{{$p->property->property_title}}</h3>
        @break
        @endforeach

          <div class="box-tools">
          <a href="{{url('manager/place/create',$property_id)}}" class="btn btn-primary no-margin pull-right">Add New</a>
        </div>
    </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
                
            <tr>
              <th>Serial</th>
              <th>Category</th>
              <th>Subcategory</th>
              <th>Place No</th>
              <th>Features</th>
              <th>Size</th>
              <th>Rent</th>
              <th>Status</th>
              <th>Action</th>

            </tr>
            @foreach ($places as $place)
            <tr>
              <td>{{ ($loop->index + 1) }}</td>
              <td>{{$place->category->name}}</td>
              <td>{{$place->subcategory->name}}</td>
              <td>{{$place->place_no}}</td>
              <td>{{$place->features}}</td>
              <td>{{$place->size}}</td>
              <td>{{$place->rent}}</td>
              <td>
                <?php if($place->status==0){?><span class="label label-danger">Vacant</span>
                <?php }
                else{ ?>
               <span class="label label-success">Occupied</span>
               <?php  
                }?>
                </td>
              <td>
                    <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-info-circle"></i> </button>
                    <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i> </button>
                    <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-trash"></i> </button>
                     
              </td>
            </tr>
            @endforeach

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
@endsection
