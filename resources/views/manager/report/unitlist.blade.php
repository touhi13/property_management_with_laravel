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
        <div class="box-header bg-info">
        <h1 class="box-title ">Unit Report</h1>
          <div class="box-tools no-print">
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
              <th>Level Name</th>
              <th>Unit No</th>
              <th>Status</th>
            </tr>
            @foreach ($units as $unit)
            <tr>
              <td>{{ ($loop->index + 1) }}</td>
              <td>{{$unit->level->level_name}}</td>
              <td>{{$unit->place_no}}</td>
              <td>
                <?php if ($unit->status == 0) {?><span class="label label-danger">Vaccant</span>
                <?php } elseif($unit->status == 1) {?>
                <span class="label label-success">Occupied</span>
                <?php } ?>
             </td>
            </tr>
            @endforeach

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