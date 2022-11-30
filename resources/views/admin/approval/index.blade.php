@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manager List</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Package</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($managers as $manager)
                    <tr>
                        <td>{{$manager->id}}</td>
                        <td>{{$manager->name}}</td>
                        <td>{{$manager->email}}</td>
                        <td>{{$manager->phone}}</td>
                        <td>{{$manager->package->name}}</td>
                        <td>
                            <?php if($manager->is_active==0){?><span class="label label-danger">Not Approved</span>
                            <?php }
                else{ ?>
                            <span class="label label-success">Approved</span>
                            <?php  
                }?>
                        </td>
                        <td>
                            <?php if($manager->is_active==0){?>
                            <button type="button" class="btn btn-secondary btn-circle approved"
                                mid = "{{$manager->id}}"><i
                                    class="fa fa-check"></i> </button> <?php }
                    else{ ?>
                            <button type="button" class="btn btn-secondary btn-circle notapproved"
                                mid="{{$manager->id}}"><i
                                    class="fa fa-times"></i> </button>
                            <?php

                    }

                     ?>
                            <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                            </button>
                            {!! Form::open(['method' => 'DELETE','route' => ['approval.destroy',
                            $manager->id],'style'=>'display:inline','onsubmit' => 'return confirm("Are you sure ?")'])
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
        $(".approved").click(function () {
            if (confirm('Are you sure?')) {
                $managerid = $(this).attr('mid');
                //console.log($managerid);
                $.ajax({
                    type: "post",
                    url: url + '/admin/setmanagerapproval',
                    data: {
                        id: $managerid,
                        action: "allow"
                    },
                    dataType: "json",
                    success: function (d) {
                        alert(d.message);
                        location.reload();
                    }
                });
            }
            return false;
        });

        $(".notapproved").click(function () {
            if (confirm('Are you sure?')) {
                $managerid = $(this).attr('mid');

                $.ajax({
                    type: "post",
                    url: url + '/admin/setmanagerapproval',
                    data: {
                        id: $managerid,
                        action: "deny"
                    },
                    dataType: "json",
                    success: function (d) {
                        alert(d.message);
                        location.reload();
                    }
                });
            }
            return false;
        });
    });

</script>
@endsection
