@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Payment</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Serial</th>
                        <th>Manager Name</th>
                        <th>Payment Type</th>
                        <th>Transaction Id</th>
                        <th>Package Name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$payment->manager['name']}}</td>

                        @if($payment->paymenttype==1)
                        <td>Bkash</td>
                        @elseif($payment->paymenttype==2)
                        <td>Check</td>
                        @elseif($payment->paymenttype==3)
                        <td>Cash On Delivery</td>
                        @endif
                        
                        <td>{{$payment->transaction_id}}</td>
                        <td>{{$payment->package->name}}</td>
                        <td>{{$payment->package->price}}</td>
                        <td>
                            <a href="{{url('admin/package/'.$payment->id.'/edit')}}">
                                <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                                </button>
                            </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['package.destroy',
                            $payment->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")'])
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
