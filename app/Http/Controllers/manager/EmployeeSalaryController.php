<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Employee;
use App\EmployeeSalary;
use App\Expense;
use App\Property;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $m = date('m');
        $y = date('Y');
        $checkSalary = EmployeeSalary::where('manager_id', Auth::id())->where('month', $m)->where('year', $y)->exists();
        if(!$checkSalary){
            $getemployee = Employee::with('property')->where('manager_id', Auth::id())->where('status', 0)->get();
            foreach ($getemployee as $employee) {
                $insertemployee = new EmployeeSalary();
                $insertemployee->manager_id = $employee->manager_id;
                $insertemployee->property_id = $employee->property_id;
                $insertemployee->employee_id = $employee->id;
                $insertemployee->month = $m;
                $insertemployee->year = $y;
                //$insertemployee->salary_date = date('Y-m-d');
                $insertemployee->save();

            }
            $showSalary = EmployeeSalary::where('manager_id', Auth::id())->where('month', $m)->where('year', $y)->get();
            return view('manager.salary.index')->with('salaries', $showSalary);
        }

     else {
        $showSalary = EmployeeSalary::where('manager_id', Auth::id())->where('month', $m)->where('year', $y)->get();
        //dd($showrent);
        return view('manager.salary.index')->with('salaries', $showSalary);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title','id');
        return view('manager.salary.create')->with('properties', $property);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $e = EmployeeSalary::find($id);
        //dd($r);
        $e->amount = $request->give_salary;
        $e->salary_date = date('Y-m-d');
        $e->status = 1;
        if ($e->update()) {
            $exp = new Expense();
            $exp->manager_id = Auth::id();
            $exp->expense_name = 'Salary';
            $exp->expense_desc = 'Giving salary for '.$e->employee->position_name. ' Post for ' .$e->property->property_title;
            $exp->expense_date = date('Y-m-d');
            $exp->month = date('m');
            $exp->year = date('Y');
            $exp->amount = $request->give_salary;
            if ($exp->save()) {
                return redirect()->route('employee_salary')
                    ->with('message', 'The salary has been paid');
            } else {
                return redirect()->route('employee_salary')
                    ->with('message', 'Error!!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function giveSalary(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            'employee_id' => 'required',
            'give_salary' => 'required|numeric',
        ]);
        $id = $request->employee_id;
        $e = EmployeeSalary::where('employee_id',$id)->where('month',date('m'))->where('year', date('Y'))->firstOrFail();
        //dd($r);
        $e->amount = $request->give_salary;
        $e->salary_date = date('Y-m-d');
        $e->status = 1;
        if ($e->update()) {
            $exp = new Expense();
            $exp->manager_id = Auth::id();
            $exp->expense_name = 'Salary';
            $exp->expense_desc = 'Giving salary for '.$e->employee->position_name. ' Post for ' .$e->property->property_title;
            $exp->expense_date = date('Y-m-d');
            $exp->month = date('m');
            $exp->year = date('Y');
            $exp->amount = $request->give_salary;
            if ($exp->save()) {
                return redirect()->route('employee_salary.index')
                    ->with('success', 'Category updated successfully');
            } else {
                return redirect()->route('employee_salary.index')
                    ->with('success', 'Error!!');
            }
        }
    }

    public function selectemployee($id)
    {
        $employee = Employee::where('property_id', $id)->get()->toArray();
        return response()->json($employee);
    }
}
