<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{BlogCategory};

class BlogController extends Controller
{
    public function AllBlogCategory(){
        $category = BlogCategory::latest()->get();
        return view('backend.blog.BlogCategory', compact('category'));
    }

    public function StoreBlogCategory(Request $request)
    {
        BlogCategory::insert([
            'category_name'=>$request->category_name,
            'category_slug'=> strtolower(str_replace(' ','-', $request->category_name)),
        ]);
        $notification = array(
            'message'=>'BlogCategory Created Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.blog.category')->with($notification);
    }

    public function EditBlogCategory($id){
        $categories = BlogCategory::findOrFail($id);
        return response()->json($categories);
    }

    public function UpdateBlogCategory(Request $request)
    {
        $cat_id = $request->cat_id;
        BlogCategory::findOrFail($cat_id)->update([
            'category_name'=>$request->category_name,
            'category_slug'=> strtolower(str_replace(' ','-', $request->category_name)),
        ]);
        $notification = array(
            'message'=>'BlogCategory Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.blog.category')->with($notification);
    }

    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message'=>'BlogCategory Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function AllPost(){

    }
}
