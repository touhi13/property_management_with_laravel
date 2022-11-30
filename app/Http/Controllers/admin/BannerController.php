<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class BannerController extends Controller
{
    public function image()

    {
        $banner =Banner::all();
        return view('admin.banner.image')->with('banner',$banner);
    }

    public function bannerupload(Request $request)
    {      
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $rand = mt_rand(100000, 999999);
            $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
            //$name_thumb = time() . "_" . Auth::id() . "_" . $rand . "_thumb." . $image->getClientOriginalExtension();
            //return response()->json(['a'=>storage_path() . '/app/public/postimages/'. $name]);
            //move image to postimages folder
            $image->move(storage_path() . '/app/public/banner/', $name);
            $resizedImage = Image::make(storage_path() . '/app/public/banner/' . $name)->resize(1900, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            // $resizedImage_thumb = Image::make(storage_path() . '/app/public/banner/' . $name)->resize(128, 128, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // save file as jpg with medium quality
            $resizedImage->save(storage_path() . '/app/public/banner/' . $name, 60);
            // $resizedImage_thumb->save(storage_path() . '/app/public/banner/' . $name_thumb, 70);
            //$data[] = $name;
        } else {
            $name = 'not-found.jpg';
        }
      $image = new Banner();
    //   $image->status=0;
      $image->image= $name;
    
      if ($image->save()) {
        return redirect('admin/banner')->with('message', 'Banner Created Successfully');
    } else {
        return redirect('admin/banner')->with('message', 'Error!!');
    }
    }
}
