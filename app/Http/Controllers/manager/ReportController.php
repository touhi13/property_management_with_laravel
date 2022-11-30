<?php

namespace App\Http\Controllers\manager;

use App\Employee;
use App\EmployeeSalary;
use App\Http\Controllers\Controller;
use App\Place;
use App\Property;
use App\Tenant;
use App\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RentCollectionDate;

class ReportController extends Controller
{
    public function index()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        //dd($property);
        return view('manager.report.index')->with('allpro', $property);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'property_id' => 'required'         

        ]);

        $p_id = $request->property_id;
        $l_id = $request->level_id;
        $u_id = $request->unit_id;
        // $m = $request->month;
        // $y = $request->year;
        if (!$l_id) {
            //echo(1);
            $gettenant = Tenant::where('manager_id', Auth::id())->where('property_id', $p_id)->get();
        } elseif (!$u_id) {
            //echo(2);
            $gettenant = Tenant::where('property_id', $p_id)->where('level_id', $l_id)->get();
        } else {
            //echo(3);exit;
            $gettenant = Tenant::where('property_id', $p_id)->where('level_id', $l_id)->where('place_id', $u_id)->get();
        }
        return view('manager.report.tenantlist')->with('tenants', $gettenant);
    }

    public function unitreport()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.report.unit')->with('properties', $property);
    }

    public function unitReportResult(Request $request)
    {
        $request->validate([
            'property_id' => 'required'         

        ]);

        $pid = $request->property_id;
        $lid = $request->level_id;
        $status = $request->status;
        if (!$lid) {
            //if (empty($status) && $status != 0) {
            if (empty($status)) {
                $getunit = Place::where('property_id', $pid)->get();
            } else {
                $getunit = Place::where('property_id', $pid)->where('status', $status)->get();
            }
        } elseif (!$status) {
            $getunit = Place::where('property_id', $pid)->where('level_id', $lid)->get();
        } else {
            $getunit = Place::where('property_id', $pid)->where('level_id', $lid)->where('status', $status)->get();
        }
        return view('manager.report.unitlist')->with('units', $getunit);
    }
    public function salaryreport()
    {
        $getemployee = Employee::where('manager_id', Auth::id())->pluck('name', 'id');
        return view('manager.report.salary')->with('employees', $getemployee);
    }

    public function salaryReportResult(Request $request)
    {   
        $request->validate([
            'employee_id' => 'required'         

        ]);

        $e = $request->employee_id;
        $y = $request->year;
        $m_m = $request->month;
        $m = ($m_m < 10) ? '0' . $m_m : $m_m;
        //echo $e,$y,$m;exit;
        if (!$y) {
            //echo '2019';exit;
            $employeeSalary = EmployeeSalary::where('employee_id', $e)->get();
        } elseif (!$m) {
            //echo 'may';exit;
            $employeeSalary = EmployeeSalary::where('employee_id', $e)->where('year', $y)->get();
        } else {
            //echo '25';exit;
            $employeeSalary = EmployeeSalary::where('employee_id', $e)->where('year', $y)->where('month', $m)->get();
        }
        return view('manager.report.salarylist')->with('salaries', $employeeSalary);
    }
    public function rentReport()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.report.rent')->with('properties', $property);
    }
    public function rentresult(Request $request)
    {   
        $request->validate([
            'property_id' => 'required'        

        ]);
        
        $p = $request->property_id;
        $l = $request->level_id;
        $t = $request->tenant_id;
        $y = $request->year;
        $m_m = $request->month;
        $m = ($m_m < 10) ? '0' . $m_m : $m_m;
        //echo $p,$l,$u,$y,$m;exit;
        if (!$l) {
            if (!$y) {
                $rent = Rent::where('property_id', $p)->get();
            } elseif (!$m) {
                $rent = Rent::where('property_id', $p)->where('year', $y)->get();
            } else {
                $rent = Rent::where('property_id', $p)->where('year', $y)->where('month', $m)->get();
            }
        } elseif (!$t) {
            if (!$y) {
                $rent = Rent::where('property_id', $p)->where('level_id', $l)->get();
            } elseif (!$m) {
                $rent = Rent::where('property_id', $p)->where('level_id', $l)->where('year', $y)->get();
            } else {
                $rent = Rent::where('property_id', $p)->where('level_id', $l)->where('year', $y)->where('month', $m)->get();
            }
        } elseif (!$y) {
            $rent = Rent::where('tenant_id', $t)->get();
        } elseif (!$m) {
            $rent = Rent::with('tenant', 'rentcollectiondates')->where('tenant_id', $t)->where('year', $y)->get();
        } else {
            $rent = Rent::where('tenant_id', $t)->where('year', $y)->where('month', $m)->get();
        }
        //dd($rent);
        return view('manager.report.rentlist')->with('rents', $rent);
    }

    public function selecttenant($id)
    {
        $tenant = Tenant::leftJoin('places', 'tenants.place_id', '=', 'places.id')->select('tenants.*', 'places.place_no')->where('tenants.level_id', $id)->where('tenants.status', 0)->get()->toArray();
        return response()->json($tenant);
    }
}
