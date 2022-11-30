<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Property;
use App\Level;
use App\Place;
use App\Tenant;
use App\Employee;
use App\Rent;
use App\Expense;
use App\EmployeeSalary;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = Property::where('manager_id', Auth::id())->get()->count();
        $level = Level::where('manager_id', Auth::id())->get()->count();
        $unit = Place::where('manager_id', Auth::id())->get()->count();
        $tenant = Tenant::where('manager_id', Auth::id())->get()->count();
        $employee = Employee::where('manager_id', Auth::id())->get()->count();
        $rent = Rent::where('manager_id', Auth::id())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');
        $expense = Expense::where('manager_id', Auth::id())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');
        $salary = EmployeeSalary::where('manager_id', Auth::id())->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('amount');
        return view('manager.dashboard.index')
            ->with('properties', $property)
            ->with('levels', $level)
            ->with('units', $unit)
            ->with('tenants', $tenant)
            ->with('employees', $employee)
            ->with('rents', $rent)
            ->with('expenses', $expense)
            ->with('salaries', $salary);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
    public function getVaccantUnit()
    {
        $unit = DB::table('places')->leftjoin('properties','places.property_id', '=', 'properties.id')->where('places.manager_id', Auth::id())->where('places.status', 0)->select('properties.property_title as properties', DB::raw('count(*) as total'))->groupBy('properties')->get()->toArray();
        return response()->json($unit);
    }
}
