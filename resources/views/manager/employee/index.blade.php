@extends('layouts.manager')
@section('content')

<div class="row">


    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Employee List</h3>
                <div class="box-tools">
                    <a href="{{url('manager/employee/create')}}" class="btn btn-primary no-margin pull-right">Add
                        New</a>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Postion Name</th>
                        <th>Gender</th>
                        <th>National Id</th>
                        <th>phone</th>
                        <th>Permanent Address</th>
                        <th>Property</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->position_name}}</td>
                        <td>{{$employee->gender}}</td>
                        <td>{{$employee->national_id}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->permanent_address}}</td>
                        <td>{{$employee->property->property_title}}</td>
                        <td>{{$employee->salary}}</td>

                        <td>
                            <?php if ($employee->status == 0) {?><span class="label label-danger">Active</span>
                            <?php } else {?>
                            <span class="label label-success">Disable</span>
                            <?php
}?>
                        </td>
                        <td>
                            <?php if ($employee->status == 0) {?>
                            <button type="button" class="btn btn-secondary btn-circle dctive" eid="{{$employee->id}}"><i
                                    class="fa fa-times"></i> </button>
                            <?php } else {?>
                            <button type="button" class="btn btn-secondary btn-circle active" id=""
                                eid="{{$employee->id}}"><i class="fa fa-check"></i> </button>
                            <?php

}

?>
                            <a href="{{url('manager/employee/'.$employee->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['employee.destroy',
                            $employee->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")'])
                            !!}
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
<script>
    $(document).ready(function () {
        //header for csrf-token is must in laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //
        var url = "{{URL::to('/')}}";

        $(".dctive").click(function () {
            $employeeid = $(this).attr('eid');
            console.log($employeeid);
            //alert(5)
            $.ajax({
                type: "post",
                url: url + '/manager/employeeout',
                data: {
                    id: $employeeid,
                    action: "out"
                },
                dataType: "json",
                success: function (d) {
                    alert(d.message);
                    location.reload();

                }
            });

        });

        $(".active").click(function () {
            $employeeid = $(this).attr('eid');
            //console.log($managerid);
            $.ajax({
                type: "post",
                url: url + '/manager/employeeout',
                data: {
                    id: $employeeid,
                    action: "in"
                },
                dataType: "json",
                success: function (d) {
                    alert(d.message);
                    location.reload();

                }
            });

        });

    });

</script>
@endsection
