<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\{PropertyType, State};
use App\Models\{Amenities, PropertyMessage};
use App\Models\{User, PackagePlan};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $p_state = State::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.AddProperty', compact('property_type','amenities','activeAgent','p_state'));
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

    public function DetailsProperty($id)
    {
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);
        $amen_type = $property->amenities_id;
        $property_amenities = explode(',',$amen_type);

        $multi_image = MultiImage::where('property_id',$id)->get();

        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.DetailsProperty', compact('property','property_type','amenities','activeAgent','property_amenities','multi_image','facilities'));
    }

    public function EditProperty($id)
    {
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);
        $amen_type = $property->amenities_id;
        $property_amenities = explode(',',$amen_type);

        $multi_image = MultiImage::where('property_id',$id)->get();
        $p_state = State::latest()->get();

        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.EditProperty', compact('property','property_type','amenities','activeAgent','property_amenities','multi_image','facilities','p_state'));
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

    public function UpdatePropertyMultiImage(Request $request)
    {
        $imgs = $request->multi_img;
        foreach ($imgs as $id => $image) {
            $img_del = MultiImage::findOrFail($id);
            unlink(public_path('upload/property/multi-image/'.$img_del->photo_name));

            $manager = new ImageManager(new Driver());
            $img_extension = $image->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($image)->resize(770,520);
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/property/multi-image/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/property/multi-image/'.$new_name));
            }
            MultiImage::where('id',$id)->update([
                'photo_name'=>$new_name,
                'updated_at'=>now(),
            ]);
        }
        $notification = array(
            'message'=>'Property Multi-Image Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function DeletePropertyMultiImage($id)
    {
        $old_img = MultiImage::findOrFail($id);
        unlink(public_path('upload/property/multi-image/'.$old_img->photo_name));
        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message'=>'Property Multi-Image Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function StoreNewMultiImage(Request $request)
    {
        $new_multi = $request->image_id;
        $image = $request->file('multi_img');
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
            'property_id'=>$new_multi,
            'photo_name'=>$new_name,
            'created_at'=>now(),
        ]);
        $notification = array(
            'message'=>'Property Multi-Image Added Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function UpdatePropertyFacilities(Request $request)
    {
        $p_id = $request->id;
        if ($request->facility_name == NULL) {
            return redirect()->back();
        } else {
            Facility::where('property_id',$p_id)->delete();
            $facilities = Count($request->facility_name);
            for ($i=0; $i < $facilities; $i++) {
                $f_count = new Facility();
                $f_count->property_id = $p_id;
                $f_count->facility_name = $request->facility_name[$i];
                $f_count->distance = $request->distance[$i];
                $f_count->save();
            }
        }
        $notification = array(
            'message'=>'Property Facility Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink(public_path('upload/property/thumbnail/'.$property->property_thumbnail));
        Property::findOrFail($id)->delete();
        $images = MultiImage::where('property_id',$id)->get();
        foreach ($images as $image) {
            unlink(public_path('upload/property/multi-image/'.$image->photo_name));
        }
        MultiImage::where('property_id',$id)->delete();
        $facilitiesData = Facility::where('property_id',$id)->get();
        foreach ($facilitiesData as $item) {
            $item->facility_name;
        }
        Facility::where('property_id',$id)->delete();
        $notification = array(
            'message'=>'Property Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function InactiveProperty(Request $request)
    {
        $p_id = $request->id;
        Property::findOrFail($p_id)->update([
            'status'=>0,
        ]);
        $notification = array(
            'message'=>'Property Inactive Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.property')->with($notification);
    }

    public function ActiveProperty(Request $request)
    {
        $p_id = $request->id;
        Property::findOrFail($p_id)->update([
            'status'=>1,
        ]);
        $notification = array(
            'message'=>'Property Active Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.property')->with($notification);
    }

    public function AdminPackageHistory(){
        $package_history = PackagePlan::latest()->get();
        return view('backend.package.PackageHistory',compact('package_history'));
    }

    public function PackageInvoice($id){
        $package_history = PackagePlan::where('id',$id)->first();
        $pdf = Pdf::loadView('backend.package.PackageHistoryInvoice', compact('package_history'))->setPaper('a4')->setOption([
            'tempDir'=> public_path(),
            'chroot'=> public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function AdminPropertyMessage(){
        $user_msg = PropertyMessage::latest()->get();
        return view('backend.message.AllMessage',compact('user_msg'));
    }

}
