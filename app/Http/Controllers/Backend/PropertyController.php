<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view('backend.property.AllProperty', compact('property'));
    }

    public function AddProperty()
    {
        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.AddProperty', compact('property_type','amenities','activeAgent'));
    }

    public function StoreProperty(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(",",$amen);
        // dd($amenities);
        $p_code = IdGenerator::generate(['table'=>'properties','field'=>'property_code','length'=>5,'prefix'=>'PC']);
        if ($request->hasFile('property_thumbnail')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('property_thumbnail')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('property_thumbnail'))->resize(370,250);
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/property/thumbnail/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/property/thumbnail/'.$new_name));
            }
            // $save_url = 'upload/property/thumbnail/'.$new_name;
            $property_id = Property::insertGetId([
                'ptype_id'=>$request->ptype_id,
                'amenities_id'=>$amenities,
                'property_name'=>$request->property_name,
                'property_slug'=>strtolower(str_replace(" ","-",$request->property_name)),
                'property_code'=>$p_code,
                'property_status'=>$request->property_status,

                'lowest_price'=>$request->lowest_price,
                'max_price'=>$request->max_price,
                'short_descrip'=>$request->short_descrip,
                'long_descrip'=>$request->long_descrip,
                'bedrooms'=>$request->bedrooms,
                'bathrooms'=>$request->bathrooms,
                'garage'=>$request->garage,
                'garage_size'=>$request->garage_size,

                'property_size'=>$request->property_size,
                'property_video'=>$request->property_video,
                'address'=>$request->address,
                'city'=>$request->city,
                'state'=>$request->state,
                'postal_code'=>$request->postal_code,

                'neighborhood'=>$request->neighborhood,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'featured'=>$request->featured,
                'hot'=>$request->hot,
                'agent_id'=>$request->agent_id,

                'status'=>1,
                'property_thumbnail'=>$new_name,
                'created_at'=>now(),
            ]);
            // Multiple Image Upload
            $images = $request->file('multi_img');
            foreach ($images as $image) {
                $manager = new ImageManager(new Driver());
                $img_extension = $image->getClientOriginalExtension();
                $new_name = hexdec(uniqid()).".".$img_extension;
                $img = $manager->read($image)->resize(770,520);
                if ($img_extension == "png") {
                    $img->toPng(80)->save(base_path('public/upload/property/multi-image/'.$new_name));
                } else {
                    $img->toJpeg(80)->save(base_path('public/upload/property/multi-image/'.$new_name));
                }
                MultiImage::insert([
                    'property_id'=>$property_id,
                    'photo_name'=>$new_name,
                    'created_at'=>now(),
                ]);
            }
            $facilities = Count($request->facility_name);
            if ($facilities != NULL) {
                for ($i=0; $i < $facilities; $i++) {
                    $f_count = new Facility();
                    $f_count->property_id = $property_id;
                    $f_count->facility_name = $request->facility_name[$i];
                    $f_count->distance = $request->distance[$i];
                    $f_count->save();
                }
            }
        }
        $notification = array(
            'message'=>'Property Inserted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.property')->with($notification);
    }

    public function EditProperty($id)
    {
        $property = Property::findOrFail($id);
        $amen_type = $property->amenities_id;
        $property_amenities = explode(',',$amen_type);

        $multi_image = MultiImage::where('property_id',$id)->get();

        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.EditProperty', compact('property','property_type','amenities','activeAgent','property_amenities','multi_image'));
    }

    public function UpdateProperty(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(",",$amen);

        $property_id = $request->id;
        Property::findOrFail($property_id)->update([
            'ptype_id'=>$request->ptype_id,
            'amenities_id'=>$amenities,
            'property_name'=>$request->property_name,
            'property_slug'=>strtolower(str_replace(" ","-",$request->property_name)),
            'property_status'=>$request->property_status,

            'lowest_price'=>$request->lowest_price,
            'max_price'=>$request->max_price,
            'short_descrip'=>$request->short_descrip,
            'long_descrip'=>$request->long_descrip,
            'bedrooms'=>$request->bedrooms,
            'bathrooms'=>$request->bathrooms,
            'garage'=>$request->garage,
            'garage_size'=>$request->garage_size,

            'property_size'=>$request->property_size,
            'property_video'=>$request->property_video,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postal_code'=>$request->postal_code,

            'neighborhood'=>$request->neighborhood,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'featured'=>$request->featured,
            'hot'=>$request->hot,
            'agent_id'=>$request->agent_id,
            'updated_at'=>now(),
        ]);

        $notification = array(
            'message'=>'Property Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.property')->with($notification);
    }

    public function UpdatePropertyThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $old_img = $request->old_img;
        if ($request->hasFile('property_thumbnail')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('property_thumbnail')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('property_thumbnail'))->resize(370,250);
            if (file_exists('upload/property/thumbnail/'.$old_img)) {
                unlink(public_path('upload/property/thumbnail/'.$old_img));
            }
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/property/thumbnail/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/property/thumbnail/'.$new_name));
            }
            Property::findOrFail($pro_id)->update([
                'property_thumbnail'=>$new_name,
                'updated_at'=>now(),
            ]);
        }
        $notification = array(
            'message'=>'Property Thumbnail Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    // public function DeleteType($id)
    // {
    //     PropertyType::findOrFail($id)->delete();
    //     $notification = array(
    //         'message'=>'Property Type Deleted Successfully',
    //         'alert-type'=>'success',
    //     );
    //     return redirect()->back()->with($notification);
    // }
}
