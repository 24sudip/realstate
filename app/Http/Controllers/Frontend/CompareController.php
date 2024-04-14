<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Compare};
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $property_id){
        if (Auth::check()) {
            $exists = Compare::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (!$exists) {
                Compare::insert([
                    'user_id'=>Auth::id(),
                    'property_id'=>$property_id,
                    'created_at'=>now(),
                ]);
                return response()->json(['success'=>'Successfully Added On Your Comparelist']);
            } else {
                return response()->json(['error'=>'This Property Is Already In Your Comparelist']);
            }
        } else {
            return response()->json(['error'=>'First Login At Your Account']);
        }
    }

    public function UserCompare(){
        return view('frontend.userDashboard.Compare');
    }

    public function GetCompareProperty(){
        $compare = Compare::with('relation_to_property')->where('user_id', Auth::id())->latest()->get();
        return response()->json($compare);
    }

    public function CompareRemove($id){
        Compare::where('user_id', Auth::id())->where('id',$id)->delete();
        return response()->json(['success'=>'Successfully Property Removed']);
    }
}
