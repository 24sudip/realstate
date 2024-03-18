<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'Admin Logged Out Successfully',
            'alert-type'=>'success',
        );

        return redirect(route('admin.login'))->with($notification);
    }

    public function AdminLogin()
    {
        return view('admin.AdminLogin');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('admin.AdminProfileView', compact('profile_data'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->user_name = $request->user_name;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_photos/'.$data->photo));
            $file_name = date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_photos'),$file_name);
            $data['photo'] = $file_name;
        }
        $data->save();
        $notification = array(
            'message'=>'Admin Profile Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('admin.AdminChangePassword', compact('profile_data'));
    }

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
            'message'=>'Old Password Does Not Match!',
            'alert-type'=>'error',
            );
            return back()->with($notification);
        } else {
            User::whereId(auth()->user()->id)->update([
                'password'=>Hash::make($request->new_password),
            ]);
            $notification = array(
            'message'=>'Password Changed Successfully',
            'alert-type'=>'success',
            );
            return back()->with($notification);
        }

    }
    // Agent User All Method
    public function AllAgent()
    {
        $all_agent = User::where('role','agent')->get();
        return view('backend.agentUser.AllAgent', compact('all_agent'));
    }

    public function AddAgent()
    {
        return view('backend.agentUser.AddAgent');
    }

    // public function StoreAmenities(Request $request)
    // {
    //     Amenities::insert([
    //         'amenities_name'=>$request->amenities_name,
    //     ]);
    //     $notification = array(
    //         'message'=>'Amenities Created Successfully',
    //         'alert-type'=>'success',
    //     );
    //     return redirect()->route('all.amenities')->with($notification);
    // }

    // public function EditAmenities($id)
    // {
    //     $amenities = Amenities::findOrFail($id);
    //     return view('backend.amenities.EditAmenities', compact('amenities'));
    // }

    // public function UpdateAmenities(Request $request)
    // {
    //     $ame_id = $request->id;
    //     Amenities::findOrFail($ame_id)->update([
    //         'amenities_name'=>$request->amenities_name,
    //     ]);
    //     $notification = array(
    //         'message'=>'Amenities Updated Successfully',
    //         'alert-type'=>'success',
    //     );
    //     return redirect()->route('all.amenities')->with($notification);
    // }

    // public function DeleteAmenities($id)
    // {
    //     Amenities::findOrFail($id)->delete();
    //     $notification = array(
    //         'message'=>'Amenities Deleted Successfully',
    //         'alert-type'=>'success',
    //     );
    //     return redirect()->back()->with($notification);
    // }
}
