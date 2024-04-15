<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\{Amenities, PropertyMessage};
use App\Models\{User, PackagePlan};
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug){
        $property = Property::findOrFail($id);
        $amenities = $property->amenities_id;
        $property_amen = explode(',',$amenities);

        $multi_image = MultiImage::where('property_id',$id)->get();
        $facilities = Facility::where('property_id',$id)->get();
        $type_id = $property->ptype_id;

        $related_property = Property::where('ptype_id',$type_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.property.PropertyDetails', compact('property','multi_image','property_amen','facilities','related_property'));
    }

    public function PropertyMessage(Request $request){
        $p_id = $request->property_id;
        $a_id = $request->agent_id;
        if (Auth::check()) {
            PropertyMessage::insert([
                'user_id'=>Auth::user()->id,
                'agent_id'=>$a_id,
                'property_id'=>$p_id,
                'msg_name'=>$request->msg_name,
                'msg_email'=>$request->msg_email,
                'msg_phone'=>$request->msg_phone,
                'message'=>$request->message,
                'created_at'=>now(),
            ]);
            $notification = array(
                'message'=>'Sent Message Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message'=>'Please Login Your Account First',
                'alert-type'=>'error',
            );
            return redirect()->back()->with($notification);
        }
    }
}
