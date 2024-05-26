<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{BlogCategory, BlogPost, User};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;

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
        $post = BlogPost::latest()->get();
        return view('backend.post.AllPost',compact('post'));
    }

    public function AddPost(){
        $blog_cat = BlogCategory::latest()->get();
        return view('backend.post.AddPost',compact('blog_cat'));
    }

    public function StorePost(Request $request)
    {
        if ($request->hasFile('post_image')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('post_image')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('post_image'))->resize(370,250);
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/post_images/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/post_images/'.$new_name));
            }
        }
        BlogPost::insert([
            'blog_cat_id'=>$request->blog_cat_id,
            'user_id'=>Auth::user()->id,
            'post_title'=>$request->post_title,
            'post_slug'=> strtolower(str_replace(' ','-', $request->post_title)),
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'post_tags'=>$request->post_tags,
            'post_image'=>$new_name,
            'created_at'=>now(),
        ]);
        $notification = array(
            'message'=>'BlogPost Created Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.post')->with($notification);
    }

    public function EditPost($id){
        $post = BlogPost::findOrFail($id);
        $blog_cat = BlogCategory::latest()->get();
        return view('backend.post.EditPost', compact('post','blog_cat'));
    }

    public function UpdatePost(Request $request)
    {
        $post_id = $request->id;
        if ($request->hasFile('post_image')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('post_image')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('post_image'))->resize(370,250);
            if (file_exists('upload/post_images/'.BlogPost::find($post_id)->post_image)) {
                unlink(public_path('upload/post_images/'.BlogPost::find($post_id)->post_image));
            }
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/post_images/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/post_images/'.$new_name));
            }

            BlogPost::findOrFail($post_id)->update([
                'blog_cat_id'=>$request->blog_cat_id,
                'user_id'=>Auth::user()->id,
                'post_title'=>$request->post_title,
                'post_slug'=> strtolower(str_replace(' ','-', $request->post_title)),
                'short_descp'=>$request->short_descp,
                'long_descp'=>$request->long_descp,
                'post_tags'=>$request->post_tags,
                'post_image'=>$new_name,
                'created_at'=>now(),
            ]);
            $notification = array(
                'message'=>'BlogPost Updated With Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.post')->with($notification);
        } else {
            BlogPost::findOrFail($post_id)->update([
                'blog_cat_id'=>$request->blog_cat_id,
                'user_id'=>Auth::user()->id,
                'post_title'=>$request->post_title,
                'post_slug'=> strtolower(str_replace(' ','-', $request->post_title)),
                'short_descp'=>$request->short_descp,
                'long_descp'=>$request->long_descp,
                'post_tags'=>$request->post_tags,
                'created_at'=>now(),
            ]);
            $notification = array(
                'message'=>'BlogPost Updated Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.post')->with($notification);
        }
    }

    public function DeletePost($id)
    {
        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        if (file_exists('upload/post_images/'.$img)) {
            unlink(public_path('upload/post_images/'.$img));
        }
        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message'=>'BlogPost Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function BlogDetails($slug){
        $blog = BlogPost::where('post_slug',$slug)->first();
        $tags = $blog->post_tags;
        $tags_all = explode(',',$tags);

        $b_category = BlogCategory::latest()->get();
        $d_post = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.BlogDetails', compact('blog','tags_all','b_category','d_post'));
    }

    public function BlogCatList($id){
        $blog = BlogPost::where('blog_cat_id',$id)->get();
        return view('frontend.blog.BlogCatList',compact('blog'));
    }
}
