<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\{User, PackagePlan};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AgentPropertyController extends Controller
{
    public function AgentAllProperty()
    {
        $id = Auth::user()->id;
        $property = Property::where('agent_id', $id)->latest()->get();
        return view('agent.property.AllProperty', compact('property'));
    }

    public function AgentAddProperty()
    {
        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();

        $id = Auth::user()->id;
        $property = User::where('role','agent')->where('id',$id)->first();
        $p_count = $property->credit;

        if ($p_count == 1 || $p_count == 7) {
            return redirect()->route('buy.package');
        } else {
            return view('agent.property.AddProperty', compact('property_type','amenities'));
        }
    }

    public function AgentStoreProperty(Request $request)
    {
        $id = Auth::user()->id;
        $u_id = User::findOrFail($id);
        $n_id = $u_id->credit;

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
                'agent_id'=>Auth::user()->id,

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
        User::where('id',$id)->update([
            'credit'=>DB::raw('1 + '.$n_id),
        ]);
        $notification = array(
            'message'=>'Property Inserted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentDetailsProperty($id)
    {
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);
        $amen_type = $property->amenities_id;
        $property_amenities = explode(',',$amen_type);

        $multi_image = MultiImage::where('property_id',$id)->get();

        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.DetailsProperty', compact('property','property_type','amenities','property_amenities','multi_image','facilities'));
    }

    public function AgentEditProperty($id)
    {
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);
        $amen_type = $property->amenities_id;
        $property_amenities = explode(',',$amen_type);

        $multi_image = MultiImage::where('property_id',$id)->get();

        $property_type = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.EditProperty', compact('property','property_type','amenities','property_amenities','multi_image','facilities'));
    }

    public function AgentUpdateProperty(Request $request)
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
            'agent_id'=>Auth::user()->id,
            'updated_at'=>now(),
        ]);

        $notification = array(
            'message'=>'Property Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentUpdatePropertyThumbnail(Request $request)
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

    public function AgentUpdatePropertyMultiImage(Request $request)
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

    public function AgentDeletePropertyMultiImage($id)
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

    public function AgentStoreNewMultiImage(Request $request)
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

    public function AgentUpdatePropertyFacilities(Request $request)
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

    public function AgentDeleteProperty($id)
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

    public function BuyPackage(){
        return view('agent.package.BuyPackage');
    }

    public function BuyBusinessPlan(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('agent.package.BusinessPlan', compact('user'));
    }

    public function StoreBusinessPlan(Request $request){
        $id = Auth::user()->id;
        $u_id = User::findOrFail($id);
        $n_id = $u_id->credit;
        PackagePlan::insert([
            'user_id'=>$id,
            'package_name'=>'Business',
            'package_credits'=>'3',
            'invoice'=>'ERS'.mt_rand(10000000,99999999),
            'package_amount'=>'20',
            'created_at'=>now(),
        ]);
        User::where('id',$id)->update([
            'credit'=>DB::raw('3 + '.$n_id),
        ]);
        $notification = array(
            'message'=>'You Have Purchased Basic Package Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function BuyProfessionalPlan(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('agent.package.ProfessionalPlan', compact('user'));
    }

    public function StoreProfessionalPlan(Request $request){
        $id = Auth::user()->id;
        $u_id = User::findOrFail($id);
        $n_id = $u_id->credit;
        PackagePlan::insert([
            'user_id'=>$id,
            'package_name'=>'Professional',
            'package_credits'=>'10',
            'invoice'=>'ERS'.mt_rand(10000000,99999999),
            'package_amount'=>'50',
            'created_at'=>now(),
        ]);
        User::where('id',$id)->update([
            'credit'=>DB::raw('10 + '.$n_id),
        ]);
        $notification = array(
            'message'=>'You Have Purchased Professional Package Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function PackageHistory(){
        $id = Auth::user()->id;
        $package_history = PackagePlan::where('user_id',$id)->get();
        return view('agent.package.PackageHistory',compact('package_history'));
    }

    public function AgentPackageInvoice($id){
        $package_history = PackagePlan::where('id',$id)->first();
        $pdf = Pdf::loadView('agent.package.PackageHistoryInvoice', compact('package_history'))->setPaper('a4')->setOption([
            'tempDir'=> public_path(),
            'chroot'=> public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
