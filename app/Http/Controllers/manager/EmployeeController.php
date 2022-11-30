<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::where('manager_id', Auth::id())->get();
        return view('manager.employee.index')->with('employees', $employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.employee.create')->with('allpro', $property);
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
            'full_name' => 'required',
            'gender' => 'required',
            'national_id' => 'required',
            'phone' => 'required',
            'position_name' => 'required',
            'property_id' => 'required',
            'permanent_address' => 'required',
            'salary' => 'required|numeric',
        ]);
        $newemployee = new Employee();
        $newemployee->name = $request->full_name;
        $newemployee->manager_id = Auth::id();
        $newemployee->gender = $request->gender;
        $newemployee->national_id = $request->national_id;
        $newemployee->nid_file = $request->doc;
        $newemployee->phone = $request->phone;
        $newemployee->position_name = $request->position_name;
        $newemployee->property_id = $request->property_id;
        $newemployee->permanent_address = $request->permanent_address;
        $newemployee->photo = $request->photo;
        $newemployee->salary = $request->salary;
        if ($newemployee->save()) {
            return redirect('manager/employee')->with('message', 'Employee Created Successfully');
        } else {
            return redirect('manager/employee/create')->with('message', 'Error!!');
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
        $employee = Employee::find($id);
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        $gender = [
            'male' => 'Male',
            'female' => 'Female'
        ];
        ///dd($gender);
        return view('manager.employee.edit', compact('employee'))
            ->with('properties', $property)
            ->with('genders', $gender);
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
        $upEmp = Employee::find($id);
        $upEmp->name = $request->name;
        $upEmp->position_name = $request->position_name;
        $upEmp->gender = $request->gender;
        $upEmp->national_id = $request->national_id;
        $upEmp->nid_file = $request->nid_file;
        $upEmp->phone = $request->phone;
        $upEmp->property_id = $request->property_id;
        $upEmp->salary = $request->salary;
        if ($upEmp->save()) {
            return redirect()->route('employee.index')
                ->with('message', 'Employee updated successfully');
        } else {
            return redirect()->route('employee.index')
                ->with('message', 'Error!!');
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
        if (Employee::destroy($id)) {
            return redirect('manager/employee')->with('message', 'Employee Deleted');
        } else {
            return redirect('manager/employee')->with('message', 'Error!!');
        }
    }

    public function exitemployees(Request $request)
    {
        $id = $request->id;
        //dd($id);
        $inout = Employee::find($id);
        // dd($inout);
        if ($request->action == "out") {
            $inout->status = 1;
        }
        if ($request->action == "in") {
            $inout->status = 0;
        }
        if ($inout->update() == true) {
            return response()->json(['success' => true, 'message' => 'Status Updated!']);
        }
    }
}
