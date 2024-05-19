<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{PropertyType, Testimonial};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    public function AllTestimonials()
    {
        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.AllTestimonial', compact('testimonial'));
    }

    public function AddTestimonial()
    {
        return view('backend.testimonial.AddTestimonial');
    }

    public function StoreTestimonial(Request $request)
    {
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('image')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('image'))->resize(100,100);
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/testimonials/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/testimonials/'.$new_name));
            }
        }
        Testimonial::insert([
            'name'=>$request->name,
            'position'=>$request->position,
            'message'=>$request->message,
            'image'=>$new_name,
            'created_at'=>now(),
        ]);
        $notification = array(
            'message'=>'Testimonial Created Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.testimonials')->with($notification);
    }

    public function EditTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.EditTestimonial', compact('testimonial'));
    }

    public function UpdateTestimonial(Request $request)
    {
        $test_id = $request->id;
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('image')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('image'))->resize(100,100);
            if (file_exists('upload/testimonials/'.Testimonial::find($test_id)->image)) {
                unlink(public_path('upload/testimonials/'.Testimonial::find($test_id)->image));
            }
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/testimonials/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/testimonials/'.$new_name));
            }
            Testimonial::findOrFail($test_id)->update([
                'name'=>$request->name,
                'position'=>$request->position,
                'message'=>$request->message,
                'image'=>$new_name,
                'updated_at'=>now(),
            ]);
            $notification = array(
                'message'=>'Testimonial Updated With Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.testimonials')->with($notification);
        } else {
            Testimonial::findOrFail($test_id)->update([
                'name'=>$request->name,
                'position'=>$request->position,
                'message'=>$request->message,
                'updated_at'=>now(),
            ]);
            $notification = array(
                'message'=>'Testimonial Updated Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.testimonials')->with($notification);
        }
    }

    public function DeleteTestimonial($id)
    {
        $test = Testimonial::findOrFail($id);
        $img = $test->image;
        if (file_exists('upload/testimonials/'.$img)) {
            unlink(public_path('upload/testimonials/'.$img));
        }
        Testimonial::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Testimonial Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }
}
