@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Package List</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <div class="input-group-btn">
                            <a href="{{url('admin/package/create')}}"
                                class="btn btn-primary no-margin pull-right">Create
                                New</a>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($packages as $package)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$package->name}}</td>
                        <td>{{$package->description}}</td>
                        <td>{{$package->duration}}</td>
                        <td>{{$package->price}}</td>
                        <td>
                            <?php if($package->status==0){?><span class="label label-danger">Deactived</span>
                            <?php }
                else{ ?>
                            <span class="label label-success">Actived</span>
                            <?php  
                }?>
                        </td>
                        <td>
                            <?php if($package->status==0){?>
                            <button type="button" class="btn btn-secondary btn-circle active" id=""
                                pid="{{$package->id}}"><i class="fa fa-check"></i> </button> <?php }
                    else{ ?>
                            <button type="button" class="btn btn-secondary btn-circle deactive"
                                pid="{{$package->id}}"><i class="fa fa-times"></i> </button>
                            <?php

                    }
                     ?>
                            <a href="{{url('admin/package/'.$package->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['package.destroy',
                            $package->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
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
        var url = "{{URL::to('/')}}";
        $(".active").click(function () {
            $packageId = $(this).attr('pid');
            //console.log($packageId);
            $.ajax({
                type: "post",
                url: url + '/admin/setstatus',
                data: {
                    id: $packageId,
                    action: "active"
                },
                dataType: "json",
                success: function (d) {
                    alert(d.message);
                    location.reload();
                }
            });
        });
        $(".deactvie").click(function () {
            $managerid = $(this).attr('pid');
            //console.log($packageId);
            $.ajax({
                type: "post",
                url: url + '/admin/setstatus',
                data: {
                    id: $packageId,
                    action: "deny"
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
