<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\{Facility, Schedule};
use App\Models\{PropertyType, State};
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

    public function AgentDetails($id){
        $agent = User::findOrFail($id);
        $property = Property::where('agent_id',$id)->get();
        $featured = Property::where('featured','1')->limit(3)->get();
        $rent_property = Property::where('property_status','rent')->get();
        $buy_property = Property::where('property_status','buy')->get();
        return view('frontend.agent.AgentDetails',compact('agent','property','featured','rent_property','buy_property'));
    }

    public function AgentDetailsMessage(Request $request){
        $a_id = $request->agent_id;
        if (Auth::check()) {
            PropertyMessage::insert([
                'user_id'=>Auth::user()->id,
                'agent_id'=>$a_id,
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

    public function RentProperty(){
        $property = Property::where('status','1')->where('property_status','rent')->paginate(1);
        return view('frontend.property.RentProperty',compact('property'));
    }

    public function BuyProperty(){
        $property = Property::where('status','1')->where('property_status','buy')->get();
        return view('frontend.property.BuyProperty',compact('property'));
    }

    public function PropertyType($id){
        $property = Property::where('status','1')->where('ptype_id',$id)->get();
        $p_bread = PropertyType::where('id',$id)->first();
        return view('frontend.property.PropertyType',compact('property','p_bread'));
    }

    public function StateDetails($id) {
        $property = Property::where('status','1')->where('state',$id)->get();
        $b_state = State::where('id',$id)->first();
        return view('frontend.property.StateProperty',compact('property','b_state'));
    }

    public function BuyPropertySearch(Request $request){
        $request->validate(['search'=>'required']);
        $item = $request->search;
        $s_state = $request->state;
        $s_type = $request->ptype_id;
        $property = Property::where('property_name','like','%'.$item.'%')->where('property_status','buy')->with('relation_to_type','relation_to_state')->whereHas('relation_to_state', function($q) use ($s_state){
            $q->where('state_name','like','%'.$s_state.'%');
        })->whereHas('relation_to_type', function($q) use ($s_type){
            $q->where('type_name','like','%'.$s_type.'%');
        })->get();
        return view('frontend.property.PropertySearch',compact('property'));
    }

    public function RentPropertySearch(Request $request){
        $request->validate(['search'=>'required']);
        $item = $request->search;
        $s_state = $request->state;
        $s_type = $request->ptype_id;
        $property = Property::where('property_name','like','%'.$item.'%')->where('property_status','rent')->with('relation_to_type','relation_to_state')->whereHas('relation_to_state', function($q) use ($s_state){
            $q->where('state_name','like','%'.$s_state.'%');
        })->whereHas('relation_to_type', function($q) use ($s_type){
            $q->where('type_name','like','%'.$s_type.'%');
        })->get();
        return view('frontend.property.PropertySearch',compact('property'));
    }

    public function AllPropertySearch(Request $request){
        // $request->validate(['search'=>'required']);
        $property_status = $request->property_status;
        $s_state = $request->state;
        $s_type = $request->ptype_id;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;

        $property = Property::where('status','1')->where('bedrooms',$bedrooms)
        ->where('bathrooms','like','%'.$bathrooms.'%')
        ->where('property_status',$property_status)
        ->with('relation_to_type','relation_to_state')
        ->whereHas('relation_to_state', function($q) use ($s_state){
            $q->where('state_name','like','%'.$s_state.'%');
        })->whereHas('relation_to_type', function($q) use ($s_type){
            $q->where('type_name','like','%'.$s_type.'%');
        })->get();
        return view('frontend.property.PropertySearch',compact('property'));
    }

    public function StoreSchedule(Request $request){
        $a_id = $request->agent_id;
        $p_id = $request->property_id;
        if (Auth::check()) {
            Schedule::insert([
                'user_id'=>Auth::user()->id,
                'property_id'=>$p_id,
                'agent_id'=>$a_id,
                'tour_date'=>$request->tour_date,
                'tour_time'=>$request->tour_time,
                'message'=>$request->message,
                'created_at'=>now(),
            ]);
            $notification = array(
                'message'=>'Request Sent Successfully',
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
