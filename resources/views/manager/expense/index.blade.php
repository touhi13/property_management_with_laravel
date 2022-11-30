@extends('layouts.manager')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <h3 class="box-title">Expense</h3>
          <div class="box-tools">
          <a href="{{url('manager/expense/create')}}" class="btn btn-primary no-margin pull-right">Add New</a>
        </div>
    </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
                
            <tr>
              <th>Serial</th>
              <th>Date</th>
              <th>Title</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Attachment</th>
              <th>Action</th>
              
            </tr>
            @foreach ($expenses as $expense)
            <tr>
              <td>{{ ($loop->index + 1) }}</td>
              <td>{{$expense->expense_date}}</td>
              <td>{{$expense->expense_name}}</td>
              <td>{{$expense->expense_desc}}</td>
              <td>{{$expense->amount}}</td>
              <td>{{$expense->attachment}}</td>
              <td>
                <a href="{{url('manager/expense/'.$expense->id.'/edit')}}">
                  <button type="button" class="btn btn-secondary btn-circle"><i class="fa fa-edit"></i>
                  </button>
              </a>
                  {!! Form::open(['method' => 'DELETE','route' => ['expense.destroy', $expense->id],'style'=>'display:inline','onsubmit' => 'return confirm("are you sure ?")']) !!}
                  {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit','class' => 'btn btn-secondary btn-circle']) !!}
                  {!! Form::close() !!}

                     
              </td>
            </tr>
            @endforeach

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      {!! $expenses->links() !!}
      <!-- /.box -->
    </div>
</div>
@endsection
@section('script')
@include('partial.message')
@endsection
