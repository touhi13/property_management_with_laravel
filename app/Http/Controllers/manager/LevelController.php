<?php

namespace App\Http\Controllers\manager;

use App\Level;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = Level::where('manager_id', Auth::id())->paginate(5);
        return view('manager.level.index')->with('levels', $level);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.level.create')->with('properties', $property);
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
            'name' => 'required|max:20',

        ]);
        $addLevel = new Level();
        $addLevel->manager_id = Auth::id();
        $addLevel->property_id = $request->property_id;
        $addLevel->level_name = $request->name;
        if ($addLevel->save()) {
            return redirect('manager/level')->with('message', 'Level Created Successfully');
        } else {
            return redirect('manager/level')->with('message', 'Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        $level = Level::find($id);
        return view('manager.level.edit', compact('level'))->with('properties', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upLvl = Level::find($id);
        $upLvl->property_id = $request->property_id;
        $upLvl->level_name = $request->level_name;
        if ($upLvl->save()) {
            return redirect()->route('level.index')
                ->with('message', 'Level updated successfully');
        } else {
            return redirect()->route('level.index')
                ->with('message', 'Error!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        if (Level::destroy($level->id)) {
            return redirect('manager/level')->with('message', 'Category Deleted');
        } else {
            return redirect('manager/level')->with('message', 'Error!!');
        }
    }
}
