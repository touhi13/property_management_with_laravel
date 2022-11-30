<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\Place;
use App\Tenant;
use App\Rent;
use App\Level;
use App\Seat;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenant = Tenant::with('property', 'level', 'place')->where('manager_id', Auth::id())->get();
        //dd($tenant);
        return view('manager.tenant.index')->with('tenants', $tenant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        //dd($property);
        return view('manager.tenant.create')->with('allpro', $property);
    }
    public function messunit()
    {
        //echo('ghghghghg');exit;
        return view('manager.tenant.messunit');
    }
    public function createmstenant()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        //dd($property);
        return view('manager.tenant.createmstenant')->with('allpro', $property);
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
            'email' => 'required',
            'get_in_date' => 'required|min:5',
            'property_id' => 'required',
            'level_id' => 'required',
            'place_id' => 'required',
            'security_money' => 'required|numeric',
        ]);
        $newtenant = new Tenant();
        $newtenant->name = $request->full_name;
        $newtenant->manager_id = Auth::id();
        $newtenant->gender = $request->gender;
        $newtenant->national_id = $request->national_id;
        $newtenant->phone = $request->phone;
        $newtenant->email = $request->email;
        $newtenant->get_in_date = $request->get_in_date;
        $newtenant->property_id = $request->property_id;
        $newtenant->level_id = $request->level_id;
        $newtenant->place_id = $request->place_id;
        $newtenant->security_money = $request->security_money;
        $newtenant->agreement_document = $request->doc;
        if ($newtenant->save()) {
            //dd($newtenant->id);
            $needPlaceId = Place::find($request->place_id);
            $newrent = new Rent();
            $newrent->manager_id = Auth::id();
            $newrent->property_id = $request->property_id;
            $newrent->level_id = $request->level_id;
            $newrent->place_id = $request->place_id;
            $newrent->tenant_id = $newtenant->id;
            $newrent->month = date('m');
            $newrent->year = date('Y');
            $newrent->due = 0 - $needPlaceId->rent;

            if ($newrent->save()) {
                $needPlaceId->status = 1;
            } else {
                return redirect('manager/tenant/create')->with('message', 'Error!!');
            }
            if ($needPlaceId->update()) {
                return redirect('manager/tenant')->with('message', 'Tenant Created Successfully');
            } else {
                return redirect('manager/tenant/create')->with('message', 'Error!!');
            }
        } else {
            return redirect('manager/tenant/create')->with('message', 'Error!!');
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
        $tenants = Tenant::find($id);
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.tenant.edit')->with('tenant', $tenants)->with('allpro', $property);
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
        $upTnt = Tenant::find($id);
        $upTnt->name = $request->name;
        $upTnt->gender = $request->gender;
        $upTnt->national_id = $request->national_id;
        $upTnt->phone = $request->phone;
        $upTnt->email = $request->email;
        $upTnt->property_id = $request->property_id;
        $upTnt->level_id = $request->level_id;
        $upTnt->place_id = $request->place_id;
        $upTnt->security_money = $request->security_money;
        $upTnt->get_in_date = $request->get_in_date;
        $upTnt->agreement_document = $request->doc;
        if ($upTnt->update()) {
            return redirect()->route('tenant.index')
                ->with('success', 'tenant updated successfully');
        } else {
            return redirect()->route('tenant.index')
                ->with('success', 'Error!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        if (Tenant::destroy($tenant->id)) {
            return redirect('manager/tenant')->with('message', 'Tenant Deleted');
        } else {
            return redirect('manager/tenant')->with('message', 'Error!!');
        }
    }

    public function selectplace($id)
    {
        $place = Place::where('level_id', $id)->where('status', 0)->get()->toArray();
        return response()->json($place);
    }
    public function selectunit($id)
    {
        $place = Place::where('level_id', $id)->where('status', 1)->get()->toArray();
        return response()->json($place);
    }
    public function selectlevel($id)
    {
        $level = Level::where('property_id', $id)->get()->toArray();
        return response()->json($level);
    }
    public function selectSeat($id)
    {
        $seat = Seat::where('mess_id', $id)->get()->toArray();
        return response()->json($seat);
    }
    public function exittenats(Request $request)
    {
        $id = $request->id;
        //dd($id);
        $inout = Tenant::find($id);
        // dd($inout);
        if ($request->action == "out") {
            $inout->status = 1;
            $inout->exit_date = date("Y/m/d");
        }
        if ($request->action == "in") {
            $inout->status = 0;
            $inout->exit_date = null;
        }
        if ($inout->update()) {
            $place = Place::find($inout['place_id']);
            if ($request->action == "out") {
                $place->status = 0;
            }
            if ($request->action == "in") {
                $place->status = 1;
            }

            // var_dump($inout['place_id']);
            // die();
            if ($place->update() == true) {
                return response()->json(['success' => true, 'message' => 'Status Updated!']);
            }
        }
    }
}
