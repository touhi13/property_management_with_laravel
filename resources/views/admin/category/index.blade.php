@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Category</h3>
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
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            <?php if($category->status==0){?><span class="label label-danger">Deactived</span>
                            <?php }
                else{ ?>
                            <span class="label label-success">Actived</span>
                            <?php  
                }?>
                        </td>
                        <td>
                            <?php if($category->status==0){?>
                            <button type="button" class="btn btn-secondary btn-circle approved" id=""
                                mid="{{$category->id}}"><i class="fa fa-check"></i> </button> <?php }
                    else{ ?>
                            <button type="button" class="btn btn-secondary btn-circle notapproved"
                                mid="{{$category->id}}"><i class="fa fa-times"></i> </button>
                            <?php

                    }
                     ?>
                            <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-info-circle"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-trash"></i>
                            </button>

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
