<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense=Expense::where('manager_id',Auth::id())->paginate(8);
        return view('manager.expense.index')->with('expenses',$expense);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_title.*' => 'required',
            'expense_desc.*' => 'required',
            'amount.*' => 'required|numeric'          

        ]);
        $title = $request->expense_title;
        $desc = $request->expense_desc;
        $amount = $request->amount;

        $itemCount = count($title);
        for ($i=0; $i <$itemCount; $i++) { 
            $exp = new Expense();
            $exp->manager_id = Auth::id();
            $exp->expense_name = $title[$i];
            $exp->expense_desc = $desc[$i];
            $exp->expense_date = date('Y-m-d');
            $exp->month = date('m');
            $exp->year = date('Y');
            $exp->amount = $amount[$i]; 
            $exp->save();
        }
        if($exp->save()){
            return redirect('manager/expense')->with('message','Expense Created Successfully');
        }
        else{
            return redirect('manager/expense/create')->with('message','Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('manager.expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upExp = Expense::find($id);
        $upExp->expense_name = $request->expense_name;
        $upExp->expense_desc = $request->expense_desc;
        $upExp->amount = $request->amount;
        if ($upExp->save()) {
            return redirect()->route('expense.index')
                ->with('message', 'Expense updated successfully');
        } else {
            return redirect()->route('expense.index')
                ->with('message', 'Error!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        if(Expense::destroy($expense->id)){
            return redirect('manager/expense')->with('message','Expense Deleted');
        }
        else{
            return redirect('manager/expense')->with('message','Error!!');
        }
    }
}
