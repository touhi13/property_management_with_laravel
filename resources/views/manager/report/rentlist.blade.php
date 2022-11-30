@extends('layouts.manager')
@section('css')
<style>
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;

    }
}
</style>

@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header no-print">
                <h3 class="box-title">Rent Report</h3>
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
                        <th>Collection Date</th>
                        <th>Tenant Name</th>
                        <th>Property Name</th>
                        <th>Level Name</th>
                        <th>Unit Name</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Rent</th>
                    </tr>
                    @php
                    $total = 0;
                    @endphp
                    @foreach ($rents as $rent)
                    @php
                    $total += $rent->amount;
                    @endphp
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>
                        @foreach ($rent->rentcollectiondates as $item)
                            <ul class="list-unstyled" >
                                <li>
                                    {{$item->date}}
                                </li>
                            </ul>
                        @endforeach
                        </td>
                        <td>{{$rent->tenant->name}}</td>
                        <td>{{$rent->tenant->property->property_title}}</td>
                        <td>{{$rent->tenant->level->level_name}}</td>
                        <td>{{$rent->tenant->place->place_no}}</td>
                        <td>{{date("F", mktime(0, 0, 0, $rent->month, 1))}}</td>
                        <td>{{$rent->year}}</td>
                        <td>{{$rent->amount}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="8" class="text-center">Total</th>
                        <td class="text-danger text-bold">{{$total}}</td>
                    </tr>
                </table>
                
            </div>
           
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <button id="print-window" class="no-print btn btn-primary pull-right"><i class="fa fa-print"></i> Print</button>
    </div>
    
</div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#print-window').click(function () {
            window.print();
        });
    });
</script>
@endsection