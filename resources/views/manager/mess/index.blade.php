@extends('layouts.manager')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Messes</h3>
                <div class="box-tools">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <div class="input-group-btn">
                                <a href="{{url('manager/mess/create')}}" class="btn btn-primary"
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
                        <th>Property Name</th>
                        <th>Level Name</th>
                        <th>Mess Name</th>
                        <th>Description</th>
                        <th>Action</th>

                    </tr>
                    @foreach ($messes as $mess)
                    <tr>
                        <td>{{(@$loop->index + 1)}}</td>
                        <td>{{@$mess->property->property_title}}</td>
                        <td>{{@$mess->level->level_name}}</td>
                        <td>{{@$mess->mess_name}}</td>
                        <td>{{@$mess->description}}</td>
                        <td>
                            <a href="{{url('manager/mess/'.$mess->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['mess.destroy',
                            $mess->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
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
