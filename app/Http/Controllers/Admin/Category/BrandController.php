<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Brand(){
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
    }

    public function StoreBrand(Request $request){
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',

        ]);
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if($image){
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = '../public/media/brand/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->insert($data);

            $notification=array(
                'message'=>'Brand Added',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $brand = DB::table('brands')->insert($data);

            $notification=array(
                'message'=>'Done',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function DeleteBrand($id){
        $data = DB::table('brands')->where('id',$id)->first();
        $image = $data->brand_logo;
        unlink($image);
        $brand = DB::table('brands')->where('id', $id)->delete();

        $notification=array(
            'message'=>'Brand Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditBrand($id){
        $brand= DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_category', compact('brand'));
    }

}
