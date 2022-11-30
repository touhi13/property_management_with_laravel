<?php

namespace App\Http\Controllers\admin;

use App\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package = Package::where('admin_id', Auth::id())->paginate(10);
        return view('admin.package.index')->with('packages', $package);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
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
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required',
        ]);

        $nPack = new Package();
        $nPack->admin_id = Auth::id();
        $nPack->name = $request->name;
        $nPack->description = $request->description;
        $nPack->duration = $request->duration;
        $nPack->price = $request->price;
        if($nPack->save()){
            return redirect('admin/package')->with('message','Package Created Successfully');
        }
        else{
            return redirect('admin/package/create')->with('message','Error!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $package = Package::find($package->id);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required',
        ]);

        $uPack = Package::find($package->id);
        $uPack->admin_id = Auth::id();
        $uPack->name = $request->name;
        $uPack->description = $request->description;
        $uPack->duration = $request->duration;
        $uPack->price = $request->price;
        if($uPack->update()){
            return redirect('admin/package')->with('message','Package Updated Successfully');
        }
        else{
            return redirect('admin/package')->with('message','Error!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\admin\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        if (Package::destroy($package->id)) {
            return redirect('admin/package')->with('message', 'Package Deleted');
        } else {
            return redirect('admin/package')->with('message', 'Error!!');
        }
    }
    public function setstatus(Request $request){
        $id =$request->id;
        $packageStatus = Package::find($id);
        if($request->action=="active"){
            $packageStatus->status=1;
        }
        if($request->action=="deactive"){
            $packageStatus->status=0;
        }
        $packageStatus->update();
        if($packageStatus->update()==true){
            return response()->json(['success' => true, 'message' =>'Status Updated!']);
        }
    }
}
