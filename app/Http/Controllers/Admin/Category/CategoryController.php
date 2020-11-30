<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Category(){
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }

    public function StoreCategory(Request $request){

        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification=array(
            'message'=>'Category Added',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function DeleteCategory($id){
        DB::table('categories')->where('id',$id)->delete();

        $notification=array(
            'message'=>'Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditCategory($id){
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request, $id){
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
        ]);

        $data = array();
        $data['category_name']=$request->category_name;
        $update=DB::table('categories')->where('id', $id)->update($data);
        if ($update){
            $notification=array(
                'message'=>'Category Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('categories')->with($notification);
        }else{
            $notification=array(
                'message'=>'Nothing to Updated',
                'alert-type'=>'error'
            );
            return Redirect()->route('categories')->with($notification);
        }

    }
}
