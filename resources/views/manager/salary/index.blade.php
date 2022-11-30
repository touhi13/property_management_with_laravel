@extends('layouts.manager')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Salary</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <div class="input-group-btn">
                            <a href="{{url('manager/employee_salary/create')}}" class="btn btn-primary"
                                style="margin-right: 10px;">Give Salary</a>
                        </div>
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="detailTableContainer">

                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Position Name</th>
                        <th>Property Name</th>
                        <th>Salary</th>
                        <th>Salary Status</th>

                        <th>Action</th>
                    </tr>
                    @foreach ($salaries as $salary)
                    <tr>
                        <td>{{($loop->index + 1)}}</td>
                        <td>{{$salary->employee->name}}</td>
                        <td>{{$salary->employee->position_name}}</td>
                        <td>{{$salary->property->property_title}}</td>
                        <td>{{$salary->employee->salary}}</td>
                        <td>
                            <?php if ($salary->status == 0) {?><span class="label label-danger">Not Paid</span>
                            <?php } elseif($salary->status == 1) {?>
                            <span class="label label-success">Paid</span>
                            <?php }?>
                        </td>
                        <td>
                            <?php if ($salary->status == 0) {?><Button class="btn btn-primary getid" data-toggle="modal"
                                data-target="#exampleModalCenter{{$salary->id}}">Give Salary</Button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$salary->id}}" tabindex="-1" role="dialog"
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
                                            {!!
                                            Form::open(array('route'=>['employee_salary.update',$salary->id],'method'=>'PATCH'))
                                            !!}
                                            <div class="form-group">
                                                <label for="">Give Salary</label>

                                                <input type="text" class="form-control" id="" placeholder="XXXXXX"
                                                    name="give_salary">
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
                                data-target="#exampleModalCenter{{$salary->id}}" rid="{{$salary->id}}">View
                                Details</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$salary->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="details{{$salary->id}}">
                                        </div>
                                        <div class="modal-footer">

                                            {!! Form::open(array('route' => 'employee_salary.store','method'=>'POST'))
                                            !!}
                                            <div class="row">
                                                <div class="col-xs-9">
                                                    <input type="text" class="form-control" name="collectsalary">
                                                    <input type="hidden" class="form-control" name="salary_id"
                                                        value="{{$salary->id}}">
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

@include('partial.message')

<script>
    $(document).ready(function () {
        //header for csrf-token is must in laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('rid');

        //collection details in modal

        $("#detailTableContainer").on("click", ".detailsBtn", function () {
            var d = $(this).attr('rid');
            console.log(d);
            var url = "{{URL::to('/manager/detailsalary')}}";

            $.post(url, {
                    salaryid: d
                },
                function (data, textStatus, jqXHR) {
                    console.log(data);
                    $("#details" + d).html(data);
                },
                "html"
            );
        })

    });
</script>
@endsection
