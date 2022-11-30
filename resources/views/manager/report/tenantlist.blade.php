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
                <h3 class="box-title no-print">Level</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm no-print" style="width: 150px;">
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
                        <th>Level</th>
                        <th>Unit</th>
                        <th>Rent</th>
                        <th>Rent Status</th>
                    </tr>
                    @foreach ($tenants as $tenant)
                    <tr>
                        <td>{{ ($loop->index + 1) }}</td>
                        <td>{{$tenant->name}}</td>
                        <td>{{$tenant->level->level_name}}</td>
                        <td>{{$tenant->place->place_no}}</td>
                        <td>{{$tenant->place->rent}}</td>
                        <td>
                            <?php if ($tenant->rent->status == 0) {?><span class="label label-danger">Not Paid</span>
                            <?php } elseif($tenant->rent->status == 1) {?>
                            <span class="label label-success">Paid</span>
                            <?php }elseif($tenant->rent->status == 2) {?>
                            <span class="label label-info">Advance Paid</span>
                            <?php } elseif($tenant->rent->status == 3) {?>
                            <span class="label label-warning">Partial Paid</span>
                            <?php } ?>
                        </td>
                    </tr>
                    @endforeach

                </table>
                <button id="print-window" class="no-print btn btn-primary"><i class="fa fa-print"></i> Print</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
