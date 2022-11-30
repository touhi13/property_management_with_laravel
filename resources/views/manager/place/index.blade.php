@extends('layouts.manager')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">

                <h3 class="box-title">Unit</h3>


                <div class="box-tools">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <div class="input-group-btn">
                                <a href="{{url('manager/createunit')}}" class="btn btn-primary"
                                    style="margin-right: 10px;">Create New</a>
                            </div>
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>Serial</th>
                        <th>Category</th>
                        <th>Property Name</th>
                        <th>Level Name</th>
                        <th>Place No</th>
                        <th>Subcategory</th>
                        <th>Features</th>
                        <th>Size</th>
                        <th>Rent</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    @foreach ($units as $unit)
                    <tr>
                        <td>{{(@$loop->index + 1)}}</td>
                        <td>{{@$unit->category->name}}</td>
                        <td>{{@$unit->property->property_title}}</td>
                        <td>{{@$unit->level->level_name}}</td>
                        <td>{{@$unit->place_no}}</td>
                        <td>{{@$unit->subcategory->name}}</td>
                        <td>{{@$unit->features}}</td>
                        <td>{{@$unit->size}}</td>
                        <td>{{$unit->rent}}</td>
                        <td>
                            <?php if($unit->status==0){?><span class="label label-danger">Vacant</span>
                            <?php }
                else{ ?>
                            <span class="label label-success">Occupied</span>
                            <?php  
                }?>
                        </td>
                        <td>
                            <a href="{{url('manager/place/'.$unit->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['place.destroy',
                            $unit->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit','class' => 'btn
                            btn-secondary btn-circle']) !!}
                            {!! Form::close() !!}

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
@section('script')
@include('partial.message')
@endsection
