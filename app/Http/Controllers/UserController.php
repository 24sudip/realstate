<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user_data = User::find($id);
        return view('frontend.userDashboard.EditProfile', compact('user_data'));
    }

    public function UserProfileStore(Request $request)
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
            @unlink(public_path('upload/user_photos/'.$data->photo));
            $file_name = date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/user_photos'),$file_name);
            $data['photo'] = $file_name;
        }
        $data->save();
        $notification = array(
            'message'=>'User Profile Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function UserChangePassword()
    {
        return view('frontend.userDashboard.ChangePassword');
    }

    public function UserPasswordUpdate(Request $request)
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

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'User Logged Out Successfully',
            'alert-type'=>'success',
        );

        return redirect('/login')->with($notification);
    }

    public function UserScheduleRequest()
    {
        $id = Auth::user()->id;
        $user_data = User::find($id);
        // $s_request = 
        return view('frontend.userDashboard.EditProfile', compact('user_data'));
    }
}
