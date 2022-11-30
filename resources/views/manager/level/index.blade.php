@extends('layouts.manager')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Level</h3>
                <div class="box-tools">
                    <a href="{{url('manager/level/create')}}" class="btn btn-primary no-margin pull-right">Add New</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>Serial</th>
                        <th>Property</th>
                        <th>Level Name</th>
                    </tr>
                    @foreach ($levels as $level)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$level->property->property_title}}</td>
                        <td>{{$level->level_name}}</td>
                        <td>
                            <a href="{{url('manager/level/'.$level->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['level.destroy',
                            $level->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
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
{!! $levels->links() !!}
@endsection
@section('script')
@include('partial.message')
@endsection
