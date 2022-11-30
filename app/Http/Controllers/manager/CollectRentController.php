<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rent;
use App\Tenant;
use App\Property;
use App\RentCollectionDate;

class CollectRentController extends Controller
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
        $checkrent = Rent::where('manager_id', Auth::id())->where('month', $m)->where('year', $y)->exists();
        //dd($checkrent);
        if (!$checkrent) {
            $getrent = Tenant::with('place')->where('manager_id', Auth::id())->where('status', 0)->get();
            foreach ($getrent as $rent) {
                $insertrent = new Rent();
                $insertrent->manager_id = $rent->manager_id;
                $insertrent->property_id = $rent->property_id;
                $insertrent->level_id = $rent->level_id;
                $insertrent->place_id = $rent->place_id;
                $insertrent->tenant_id = $rent->id;
                $insertrent->month = $m;
                $insertrent->year = $y;
                $insertrent->due = 0 - $rent->place->rent;
                $m1 = date('m', strtotime('last month'));
                $previousadv = Rent::where('manager_id', Auth::id())->where('tenant_id', $rent->id)->where('month', $m1)->where('year', $y)->whereNotNull('advance')->get()->toArray();
                //dd($previousadv);
                if (!empty($previousadv)) {
                    if ($previousadv[0]['advance'] == !Null) {
                        if ($rent->place->rent === $previousadv[0]['advance']) {
                            $insertrent->due = null;
                            $insertrent->status = 1;
                        } elseif ($rent->place->rent >= $previousadv[0]['advance']) {
                            $insertrent->due =  $previousadv[0]['advance'] - $rent->place->rent;
                            $insertrent->status = 3;
                        } else {
                            $insertrent->advance = $previousadv[0]['advance'] - $rent->place->rent;
                            $insertrent->status = 2;
                        }
                    }
                }

                $previousdue = Rent::where('manager_id', Auth::id())->where('tenant_id', $rent->id)->where('month', $m1)->where('year', $y)->whereNotNull('due')->get()->toArray();
                //dd($previousdue);
                if (!empty($previousdue)) {
                    if ($previousdue[0]['due'] == !Null) {
                        $insertrent->due = $previousdue[0]['due'] - $rent->place->rent;
                    }
                }

                $insertrent->save();
            }
            $showrent = Rent::where('manager_id', Auth::id())->where('month', $m)->where('year', $y)->get();
            return view('manager.rent.index')->with('rents', $showrent);
        } else {
            $showrent = Rent::where('manager_id', Auth::id())->where('month', $m)->where('year', $y)->get();
            //dd($showrent);
            return view('manager.rent.index')->with('rents', $showrent);
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
        return view('manager.rent.create')->with('properties',$property);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $laterent = new RentCollectionDate();
        $laterent->rent_id = $request->rent_id;
        $laterent->date = date('Y-m-d');
        $laterent->amount = $request->collectrent;

        if ($laterent->save()) {
            $r = Rent::find($request->rent_id);
            //dd();

            $r->amount += $request->collectrent;
            if ($r->due + $request->collectrent < 0) {
                $r->advance = null;
                $r->due = $r->due + $request->collectrent;
                $r->status = 3;
            } elseif ($r->due + $request->collectrent > 0) {
                $r->advance = $r->due + $request->collectrent;
                $r->due = null;
                $r->status = 2;
            } else {
                $r->advance = null;
                $r->due = null;
                $r->status = 1;
            }
            if ($r->update()) {
                return redirect()->route('rent.index')
                    ->with('success', 'Category updated successfully');
            } else {
                return redirect()->route('rent.index')
                    ->with('success', 'Error!!');
            }
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
        $r = Rent::find($id);
        //dd($r);
        $r->amount = $request->collect_rent;
        if ($request->collect_rent - $request->rent > 0) {
            $r->advance = $request->collect_rent - $request->rent;
            $r->due = NULL;
            $r->status = 2;
        } elseif ($request->collect_rent - $request->rent < 0) {
            $r->due = $request->collect_rent - $request->rent;
            $r->status = 3;
        } else {
            $r->advance = null;
            $r->due = null;
            $r->status = 1;
        }
        if ($r->update()) {
            $rcd = new RentCollectionDate();
            $rcd->rent_id = $id;
            $rcd->date = date('Y-m-d');
            $rcd->amount = $request->collect_rent;
            if ($rcd->save()) {
                return redirect()->route('rent.index')
                    ->with('success', 'Category updated successfully');
            } else {
                return redirect()->route('rent.index')
                    ->with('success', 'Error!!');
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

    public function drent(Request $request)
    {
        $id = $request->rentid;
        $detailrent = RentCollectionDate::where('rent_id', $id)->get();
        //dd($detailrent);
        $html = '<div class="row"><div class="col-12"><div class="box"><div class="box-header"><h3 class="box-title">Collection Details</h3></div><div class="box-body"><table class="table table-striped"><tr><th>Date</th><th>Amount</th></tr>';
        $grandTotal = 0;
        foreach ($detailrent as $dr) {
            $grandTotal += $dr->amount;
            $html .= '<tr><td>' . $dr->date . '</td><td>' . $dr->amount . '</td></tr>';
        }
        $html .= '<tr><th colspan ="1">Total</th><th>' . $grandTotal . '</th></tr></table></div></div></div></div>';
        echo $html;
    }

    public function search(Request $request)
    {
        $searchData = Tenant::leftJoin('properties', 'tenants.property_id', '=', 'properties.id')->leftJoin('rents', 'tenants.id','=','rents.tenant_id')->select('tenants.*', 'properties.property_title','rents.month', 'rents.year','rents.amount','rents.advance','rents.due','rents.status as rstatus')->where('tenants.manager_id', Auth::id())->where('rents.month', date('m'))->where('rents.year', date('Y'))->whereRaw('(`name` like "%' . $request->searchText . '%" or `properties`.`property_title` like "%' . $request->searchText . '%")')->get();
        return response()->json($searchData);
    }

    public function collectRent(Request $request)
    {   
        $request->validate([
            'property_id' => 'required',
            'level_id' => 'required',
            'tenant_id' => 'required',
            'collect_rent' => 'required|numeric'

        ]);
        $id = $request->tenant_id; 
        //echo $id;exit;
        $r = Rent::where('tenant_id',$id)->where('month',date('m'))->where('year', date('Y'))->firstOrFail();
        //dd($r);
        $r->amount = $request->collect_rent;
        if ($request->collect_rent - $request->rent > 0) {
            $r->advance = ((int)$request->collect_rent - (int)$r->due);
            $r->due = NULL;
            $r->status = 2;
        } elseif ($request->collect_rent - $request->rent < 0) {
            $r->due = $request->collect_rent - $request->rent;
            $r->status = 3;
        } else {
            $r->advance = null;
            $r->due = null;
            $r->status = 1;
        }
         if ($r->update()) {
            //echo "a";exit;
            $rcd = new RentCollectionDate();
            $rcd->rent_id = $r->id;
            $rcd->date = date('Y-m-d');
            $rcd->amount = $request->collect_rent;
            if ($rcd->save()) {
                return redirect()->route('rent.index')
                    ->with('message', 'Ren Collected');
            } else {
                return redirect()->route('rent.index')
                    ->with('message', 'Error!!');
            }
        }
    }
}

