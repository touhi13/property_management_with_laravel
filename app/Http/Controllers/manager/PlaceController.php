<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Subcategory;
use App\Property;
use App\Place;
use App\Level;
use Intervention\Image\ImageManagerStatic as Image;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Place::where('manager_id', Auth::id())->paginate(10);
        return view('manager.place.index')->with('units', $unit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $category = Category::pluck('name', 'id');
        $level = Level::where('property_id', $id)->pluck('level_name', 'id');
        return view('manager.place.create')->with('allcat', $category)->with('levels', $level)->with('proid', $id);
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
            'proid' => 'required|max:40',
            'level_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'place_no' => 'required',
            'features' => 'required',
            'size' => 'required',
            'rent' => 'required'
        ]);
        $newpl = new Place();
        $newpl->manager_id = Auth::id();
        $newpl->property_id = $request->proid;
        $newpl->level_id = $request->level_id;
        $newpl->category_id = $request->category_id;
        $newpl->subcategory_id = $request->subcategory_id;
        $newpl->place_no = $request->place_no;
        $newpl->features = $request->features;
        $newpl->size = $request->size;
        $newpl->rent = $request->rent;
        if ($newpl->save()) {
            return redirect('manager/place/create/' . $request->proid)->with('message', 'Place Created Successfully');
        } else {
            return redirect('manager/place')->with('message', 'Error!!');
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
        $category = Category::pluck('name', 'id');
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        $level = Level::where('manager_id', Auth::id())->pluck('level_name', 'id');
        $unitType = Subcategory::pluck('name', 'id');
        $unit = Place::find($id);
        return view('manager.place.edit', compact('unit'))
            ->with('categories', $category)
            ->with('properties', $property)
            ->with('levels', $level)
            ->with('unitTypes', $unitType);
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
        $upUnt = Place::find($id);
        $upUnt->property_id = $request->property_id;
        $upUnt->level_id = $request->level_id;
        $upUnt->category_id = $request->category_id;
        $upUnt->subcategory_id = $request->subcategory_id;
        $upUnt->place_no = $request->place_no;
        $upUnt->features = $request->features;
        $upUnt->size = $request->size;
        $upUnt->rent = $request->rent;
        if ($upUnt->save()) {
            return redirect('manager/place')
                ->with('message', 'Unit updated successfully');
        } else {
            return redirect('manager/place')
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
        if (Place::destroy($id)) {
            return redirect('manager/place')->with('message', 'Unit Deleted');
        } else {
            return redirect('manager/place')->with('message', 'Error!!');
        }
    }

    public function selectsubcat($id)
    {
        $subcat = Subcategory::where('category_id', $id)->get()->toArray();
        return response()->json($subcat);
    }

    public function createUnit()
    {
        $category = Category::pluck('name', 'id');
        $property = Property::where('manager_id', Auth::id())->pluck('property_title', 'id');
        return view('manager.place.createunit')->with('allcat', $category)->with('properties', $property);
    }

    public function storeUnit(Request $request)
    {
        //image upload start
        $request->validate([
            'property_id' => 'required',
            'level_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'place_no' => 'required',
            'features' => 'required|min:5',
            'size' => 'required',
            'rent' => 'required|numeric'
        ]);
        if ($request->hasfile('image')) {
            //echo 'a';exit;
            $image = $request->file('image');
            $rand = mt_rand(100000, 999999);
            $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
            $name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
            //return response()->json(['a'=>storage_path() . '/app/public/postimages/'. $name]);
            //move image to postimages folder
            $image->move(storage_path() . '/app/public/pro_img/', $name);
            $resizedImage = Image::make(storage_path() . '/app/public/pro_img/' . $name)->resize(800, 800, function ($constraint) {
                //$constraint->aspectRatio();
            });
            // $resizedImage_thumb = Image::make(storage_path() . '/app/public/pro_img/' . $name)->resize(128, 128, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // save file as jpg with medium quality
            $resizedImage->save(storage_path() . '/app/public/pro_img/' . $name, 60);
            // $resizedImage_thumb->save(storage_path() . '/app/public/pro_img/' . $name_thumb, 70);
            //$data[] = $name;
        } else {
            $name = 'not-found.jpg';
        }
        $newpl = new Place();
        $newpl->manager_id = Auth::id();
        $newpl->property_id = $request->property_id;
        $newpl->level_id = $request->level_id;
        $newpl->category_id = $request->category_id;
        $newpl->subcategory_id = $request->subcategory_id;
        $newpl->place_no = $request->place_no;
        $newpl->features = $request->features;
        $newpl->size = $request->size;
        $newpl->rent = $request->rent;
        $newpl->images = $name;
        if ($newpl->save()) {
            return redirect('manager/place/')->with('message', 'Unit Created Successfully');
        } else {
            return redirect('manager/place/createunit')->with('message', 'Error!!');
        }
    }
}
