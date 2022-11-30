@extends('layouts.manager')
@section('content') 
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Rents</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <div class="input-group-btn">
                            <a href="{{url('manager/rent/create')}}" class="btn btn-primary" style="
                            margin-right: 10px;">Collect Rent</a>
                        </div>
                        <input type="text" name="table_search" id="searchTxt" class="form-control pull-right"
                            placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" id="searchBtn" class="btn btn-default"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="detailTableContainer">
                    <tr>
                        <th>#</th>
                        <th>Tenant Name</th>
                        <th>Property Name</th>
                        <th>Place No</th>
                        <th>Rent</th>
                        <th>Advance</th>
                        <th>Due</th>

                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($rents as $rent)
                    <tr>
                        <td>{{($loop->index + 1)}}</td>
                        <td>{{$rent->tenant->name}}</td>
                        <td>{{$rent->tenant->property->property_title}}</td>
                        <td>{{$rent->tenant->place->place_no}}</td>
                        <td>{{$rent->tenant->place->rent}}</td>
                        <td>{{$rent->advance}}</td>
                        <td>{{$rent->due}}</td>
                        <td>
                            <?php if ($rent->status == 0) {?><span class="label label-danger">Not Paid</span>
                            <?php } elseif($rent->status == 1) {?>
                            <span class="label label-success">Paid</span>
                            <?php }elseif($rent->status == 2) {?>
                            <span class="label label-info">Advance Paid</span>
                            <?php } elseif($rent->status == 3) {?>
                            <span class="label label-warning">Partial Paid</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($rent->status == 0) {?><Button class="btn btn-primary getid" data-toggle="modal"
                                data-target="#exampleModalCenter{{$rent->id}}">Collect Rent</Button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$rent->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(array('route'=>['rent.update',$rent->id],'method'=>'PATCH'))
                                            !!}
                                            <div class="form-group">
                                                <label for="">Collect Rent</label>
                                                <input type="hidden" name="rent" value="{{$rent->tenant->place->rent}}">
                                                <input type="text" class="form-control" id="" placeholder="XXXXXX"
                                                    name="collect_rent">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            {{-- end modal --}}
                            <?php } else {?>
                            <button class="btn btn-info detailsBtn" data-toggle="modal"
                                data-target="#exampleModalCenter{{$rent->id}}" rid="{{$rent->id}}">View Details</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$rent->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="details{{$rent->id}}">
                                        </div>
                                        <div class="modal-footer">

                                            {!! Form::open(array('route' => 'rent.store','method'=>'POST')) !!}
                                            <div class="row">
                                                <div class="col-xs-9">
                                                    <input type="text" class="form-control" name="collectrent">
                                                    <input type="hidden" class="form-control" name="rent_id"
                                                        value="{{$rent->id}}">
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="submit" class="btn btn-primary" id="collectBtn"
                                                        Value="Collect">
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            {{-- end modal --}}
            <?php } ?>
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
dsgdgdffjfgkghghlhj;kjj;lkk;lk'lk;k;kj;kjljh
@include('partial.message')

<script>
    $(document).ready(function () {
        //header for csrf-token is must in laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //collection details in modal

        $("#detailTableContainer").on("click", ".detailsBtn", function () {
            var d = $(this).attr('rid');
            console.log(d);
            var url = "{{URL::to('/manager/detailrent')}}";

            $.post(url, {
                    rentid: d
                },
                function (data, textStatus, jqXHR) {
                    console.log(data);
                    $("#details" + d).html(data);
                },
                "html"
            );
        })

        //search

        $("#searchBtn").click(function () {
            var a = $("#searchTxt").val();
            console.log(a);
            $searchUrl = "{{URL::to('/manager/rent/search')}}";
            $.post($searchUrl, {
                searchText: $("#searchTxt").val()
            }, function (d) {
                //console.log(d);
                populateSearchData(d);
            });

        });

        function populateSearchData(d) {
            $html = '';
            d.forEach(data => {
                $$html += ''
            });
            $("#detailTableContainer").html($h);
        }


    });

</script>
@endsection
