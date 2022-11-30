<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Seat;
use App\Mess;
use App\Level;
use App\Property;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seat = Seat::where('manager_id', Auth::id())->paginate(10);
        return view('manager.seat.index')->with('seats', $seat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.seat.create')->with('properties', $property);
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
            'property_id' => 'required',
            'level_id' => 'required',
            'mess_id' => 'required',
            'seat_no' => 'required',
            'description' => 'required',
            'rent' => 'required',
        ]);
        $newSt = new Seat();
        $newSt->manager_id = Auth::id();
        $newSt->property_id = $request->property_id;
        $newSt->level_id = $request->level_id;
        $newSt->mess_id = $request->mess_id;
        $newSt->description = $request->description;
        $newSt->seat_no = $request->seat_no;
        $newSt->rent = $request->rent;
        if ($newSt->save()) {
            return redirect('manager/seat/')->with('message', 'Seat Created Successfully');
        } else {
            return redirect('manager/seat/create')->with('message', 'Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit(Seat $seat)
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        $level = Level::where('manager_id', Auth::id())->pluck('level_name', 'id');
        $mess = Mess::where('manager_id', Auth::id())->pluck('mess_name', 'id');
        $seat = Seat::find($seat->id);
        return view('manager.seat.edit', compact('seat'))
            ->with('properties', $property)
            ->with('levels', $level)
            ->with('messes', $mess);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'property_id' => 'required',
            'level_id' => 'required',
            'mess_id' => 'required',
            'seat_no' => 'required',
            'description' => 'required',
            'rent' => 'required',
        ]);
        $upSt = Seat::find($seat->id);
        $upSt->property_id = $request->property_id;
        $upSt->level_id = $request->level_id;
        $upSt->mess_id = $request->mess_id;
        $upSt->seat_no = $request->seat_no;
        $upSt->description = $request->description;
        $upSt->rent = $request->rent;
        if ($upSt->save()) {
            return redirect('manager/seat')
                ->with('message', 'Seat updated successfully');
        } else {
            return redirect('manager/seat')
                ->with('message', 'Error!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        if (Seat::destroy($seat->id)) {
            return redirect('manager/seat')->with('message', 'Seat deleted successfully');
        } else {
            return redirect('manager/seat')->with('message', 'Error!!');
        }
    }

    public function selectmess($id)
    {
        $mess = Mess::where('level_id', $id)->get()->toArray();
        return response()->json($mess);
    }
}
