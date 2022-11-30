@extends('layouts.manager')
@section('content')

<div class="row">


    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tenants</h3>
                <div class="box-tools">
                    <a href="{{url('manager/tenant/create')}}" class="btn btn-primary no-margin pull-right">Add New</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>National Id</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>Property</th>
                        <th>Level</th>
                        <th>Place</th>
                        <th>Security Money</th>
                        <th>Get in Date</th>
                        <th>Exit Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($tenants as $tenant)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$tenant->name}}</td>
                        <td>{{$tenant->gender}}</td>
                        <td>{{$tenant->national_id}}</td>
                        <td>{{$tenant->phone}}</td>
                        <td>{{$tenant->email}}</td>
                        <td>{{$tenant->property->property_title}}</td>
                        <td>{{$tenant->level->level_name}}</td>
                        <td>{{$tenant->place->place_no}}</td>
                        <td>{{$tenant->security_money}}</td>
                        <td>{{$tenant->get_in_date}}</td>
                        <td>{{$tenant->exit_date}}</td>
                        <td>
                            <?php if ($tenant->status == 0) {?><span class="label label-danger">Tenant In</span>
                            <?php } else {?>
                            <span class="label label-success">Tenant Out</span>
                            <?php
}?>
                        </td>
                        <td>
                            <?php if ($tenant->status == 0) {?>
                            <button type="button" class="btn btn-secondary btn-circle exit" tid="{{$tenant->id}}"><i
                                    class="fa fa-times"></i> </button>
                            <?php } else {?>
                            <button type="button" class="btn btn-secondary btn-circle get_in" id=""
                                tid="{{$tenant->id}}"><i class="fa fa-check"></i> </button>
                            <?php

}

?>
                            <a href="{{url('manager/tenant/'.$tenant->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['tenant.destroy',
                            $tenant->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")'])
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

        $(".exit").click(function () {
            $tenantid = $(this).attr('tid');
            console.log($tenantid);
            //alert(5)
            $.ajax({
                type: "post",
                url: url + '/manager/exittenant',
                data: {
                    id: $tenantid,
                    action: "out"
                },
                dataType: "json",
                success: function (d) {
                    alert(d.message);
                    location.reload();

                }
            });

        });

        $(".get_in").click(function () {
            $tenantid = $(this).attr('tid');
            //console.log($managerid);
            $.ajax({
                type: "post",
                url: url + '/manager/exittenant',
                data: {
                    id: $tenantid,
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
