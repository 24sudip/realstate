<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\{User, Wishlist};
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishlist(Request $request, $property_id){
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id'=>Auth::id(),
                    'property_id'=>$property_id,
                    'created_at'=>now(),
                ]);
                return response()->json(['success'=>'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error'=>'This Property Is Already In Your Wishlist']);
            }
        } else {
            return response()->json(['error'=>'First Login At Your Account']);
        }
    }

    public function UserWishlist(){
        $id = Auth::user()->id;
        $user_data = User::find($id);
        return view('frontend.userDashboard.Wishlist', compact('user_data'));
    }

    public function GetWishlistProperty(){
        $wishlist = Wishlist::with('property')->where('user_id', Auth::id())->latest()->get();
        $wishQty = $wishlist->count();
        return response()->json(['wishlist'=>$wishlist, 'wishQty'=>$wishQty]);
    }
}
