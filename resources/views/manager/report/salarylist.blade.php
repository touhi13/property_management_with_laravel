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
        <div class="box-header">
        <h3 class="box-title">Salary Report</h3>
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
              <th>Issue Date</th>
              <th>Salary Month</th>
              <th>Salary Year</th>
              <th>Salary</th>
            </tr>
            @php
                $total = 0;
            @endphp
            @foreach ($salaries as $salary)
            @php
                $total += $salary->amount;
            @endphp
            <tr>
              <td>{{ ($loop->index + 1) }}</td>
              <td>{{$salary->salary_date}}</td>
              <td>{{date("F", mktime(0, 0, 0, $salary->month, 1))}}</td>
              <td>{{$salary->year}}</td>
              <td>{{$salary->amount}}</td>
            </tr>
            @endforeach
            <tr><th colspan="4">Total</th><td class="text-danger text-bold">{{$total}}</td></tr>
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