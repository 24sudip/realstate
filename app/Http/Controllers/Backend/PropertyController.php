<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view('backend.property.AllProperty', compact('property'));
    }

    public function AddProperty()
    {
        return view('backend.property.AddProperty');
    }

    // public function StoreType(Request $request)
    // {
    //     $request->validate([
    //         'type_name'=>'required|unique:property_types|max:200',
    //         'type_icon'=>'required',
    //     ]);
    //     PropertyType::insert([
    //         'type_name'=>$request->type_name,
    //         'type_icon'=>$request->type_icon,
    //     ]);
    //     $notification = array(
    //         'message'=>'Property Type Created Successfully',
    //         'alert-type'=>'success',
    //     );
    //     return redirect()->route('all.type')->with($notification);
    // }

    // public function EditType($id)
    // {
    //     $types = PropertyType::findOrFail($id);
    //     return view('backend.type.EditType', compact('types'));
    // }

    // public function UpdateType(Request $request)
    // {
    //     $p_id = $request->id;
    //     PropertyType::findOrFail($p_id)->update([
    //         'type_name'=>$request->type_name,
    //         'type_icon'=>$request->type_icon,
    //     ]);
    //     $notification = array(
    //         'message'=>'Property Type Updated Successfully',
    //         'alert-type'=>'success',
    //     );
    //     return redirect()->route('all.type')->with($notification);
    // }

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
