@extends('layouts.manager')

@section('css')

<style>
    .btnmrgn{
        margin-top: 20px;
    }
    textarea { 
        resize:none; 
        }
</style>

@endsection


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Expense</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($expense, ['method' => 'PATCH','route' =>
        ['expense.update',$expense->id],'enctype'=>'multipart/form-data'])!!}
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <div class="box-body">
              <div id="dynamic_field">
                <div class="row">
                    <div class="col-xs-2">
                        <label for="">Expense Title</label>
                        {!! Form::text('expense_name', null, array('placeholder' => 'Property Title','class' =>
                        'form-control')) !!}
                    </div>
                    <div class="col-xs-2">
                        <label for="">Expense Description</label>
                        {!! Form::textarea('expense_desc', null, array('placeholder' => 'Enter ...','class' =>
                        'form-control')) !!}
                    </div>
                    <div class="col-xs-2">
                        <label for="">Amount</label>
                        {!! Form::text('amount', null, array('placeholder' => 'Property Title','class' =>
                        'form-control')) !!}
                    </div>
                    <div class="col-xs-2">
                        <label for="">Attachment</label>
                        <input type="file" name="image[]" id="">
                    </div>   
                </div>
            </div>
            </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          {!! Form::close() !!}
    </div>
</div>
</div>
@endsection
{{-- 
@section('script')
<script>
$(document).ready(function () {
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append(
            '<div class="row" id="row'+i+'"><div class="col-xs-2"><label for="">Expense Title</label><input type="text" class="form-control" id="" placeholder="Expense Title"name="expense_title[]"></div><div class="col-xs-2"><label for="">Expense Description</label><textarea class="form-control" name="expense_desc[]" rows="3" placeholder="Write..."></textarea></div><div class="col-xs-2"><label for="">Amount</label><input type="text" class="form-control" id="" placeholder="Amount" name="amount[]"></div><div class="col-xs-2"><label for="">Attachment</label><input type="file" name="image[]" id=""></div><div class="col-xs-2"><button type="button" name="remove" id="'+i+'" class="btn btn-primary btnmrgn btn_remove">x</button></div></div>')
    })
    $(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});

});
</script>
@endsection --}}