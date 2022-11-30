<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Property;
use App\Mess;
use App\Level;
use Illuminate\Http\Request;

class MessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mess = Mess::where('manager_id', Auth::id())->paginate(10);
        return view('manager.mess.index')->with('messes', $mess);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.mess.create')->with('properties', $property);
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
            'mess_name' => 'required',
            'description' => 'required'
        ]);
        $newms = new Mess();
        $newms->manager_id = Auth::id();
        $newms->property_id = $request->property_id;
        $newms->level_id = $request->level_id;
        $newms->mess_name = $request->mess_name;
        $newms->description = $request->description;
        if ($newms->save()) {
            return redirect('manager/mess/')->with('message', 'Mess Created Successfully');
        } else {
            return redirect('manager/mess/create')->with('message', 'Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mess  $mess
     * @return \Illuminate\Http\Response
     */
    public function show(Mess $mess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mess  $mess
     * @return \Illuminate\Http\Response
     */
    public function edit(Mess $mess)
    {

        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        $level = Level::where('manager_id', Auth::id())->pluck('level_name', 'id');
        $mess = Mess::find($mess->id);
        return view('manager.mess.edit', compact('mess'))
            ->with('properties', $property)
            ->with('levels', $level);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mess  $mess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mess $mess)
    {
        $request->validate([
            'property_id' => 'required',
            'level_id' => 'required',
            'mess_name' => 'required',
            'description' => 'required'
        ]);
        $upMs = Mess::find($mess->id);
        $upMs->property_id = $request->property_id;
        $upMs->level_id = $request->level_id;
        $upMs->mess_name = $request->mess_name;
        $upMs->description = $request->description;
        if ($upMs->save()) {
            return redirect('manager/mess')
                ->with('message', 'Mess updated successfully');
        } else {
            return redirect('manager/mess')
                ->with('message', 'Error!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mess  $mess
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mess $mess)
    {
        if (Mess::destroy($mess->id)) {
            return redirect('manager/mess')->with('message', 'Mess deleted successfully');
        } else {
            return redirect('manager/mess')->with('message', 'Error!!');
        }
    }
}
