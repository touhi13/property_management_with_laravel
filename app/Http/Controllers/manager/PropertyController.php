<?php

namespace App\Http\Controllers\manager;

use App\Category;
use App\Http\Controllers\Controller;
use App\Level;
use App\Place;
use App\Property;
use App\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class PropertyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managerId = Auth::id();

        //     $property = DB::table('properties')
        //     ->leftJoin('tenants', 'properties.id', '=','tenants.property_id')
        //    // ->leftJoin('levels', 'properties.id', '=','levels.property_id')
        //     //  ->leftJoin('places', 'properties.id', '=','places.property_id')
        //     ->select('properties.id as id',
        //     DB::raw('count(tenants.id) as tencount'),
        //    // DB::raw('count(levels.id) as levelcount'),
        //     // DB::raw('count(places.id) as placecount'),
        //     )
        //     ->where('Properties.manager_id', $managerId)
        //     //->groupBy('Properties.manager_id')
        //     ->groupBy('properties.id')
        //    // ->orderBy('id', 'DESC')
        //     ->get();

        $property = [];
        $property = Property::where('Properties.manager_id', $managerId)->paginate(8);

        foreach ($property as $key => &$val) {
            $tenant = Tenant::where('property_id', $val['id'])->get();
            $level = Level::where('property_id', $val['id'])->get();
            $place = Place::where('property_id', $val['id'])->get();

            $val['tenantCount'] = count($tenant);
            $val['levelCount'] = count($level);
            $val['placeCount'] = count($place);
        }

        //dd($property);
        return view('manager.property.index')->with('properties', $property);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        return view('manager.property.create')->with('allcat', $category);
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
            'property_title' => 'required|max:40',
            'description' => 'required|min:5',
            'address' => 'required|min:5',

        ]);

        //image upload start
        if ($request->hasfile('image')) {
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
        $newpro = new Property();
        $newpro->manager_id = Auth::id();
        $newpro->property_title = $request->property_title;
        $newpro->description = $request->description;
        $newpro->address = $request->address;
        $newpro->image = $name;
        
        //dd($newpro);
        if ($newpro->save()) {
            return redirect('manager/property')->with('message', 'Property Created Successfully');
        } else {
            return redirect('manager/property')->with('message', 'Error!!');
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
        // $proid= Place::find($id);
        //echo($proid);exit;
        $place = Place::with('property', 'category', 'subcategory')->where('property_id', $id)->orderBy('id', 'desc')->paginate(10);
        //dd($place);
        return view('manager.property.single')
            ->with('places', $place)->with('property_id', $id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);
        return view('manager.property.edit', compact('property'));
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
        $upPro = Property::find($id);
        $upPro->property_title = $request->property_title;
        $upPro->description = $request->description;
        $upPro->address = $request->address;
        if ($upPro->save()) {
            return redirect()->route('property.index')
                ->with('message', 'Property updated successfully');
        } else {
            return redirect()->route('property.index')
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
        if (Property::destroy($id)) {
            return redirect('manager/property')->with('message', 'Property Deleted');
        } else {
            return redirect('manager/property')->with('message', 'Error!!');
        }
    }
}
