<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\{User, PackagePlan};

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug){
        $property = Property::findOrFail($id);
        $amenities = $property->amenities_id;
        $property_amen = explode(',',$amenities);
        $multi_image = MultiImage::where('property_id',$id)->get();
        return view('frontend.property.PropertyDetails', compact('property','multi_image','property_amen'));
    }
}
