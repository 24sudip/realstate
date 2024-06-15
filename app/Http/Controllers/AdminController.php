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

    public function StoreAgent(Request $request)
    {
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'password'=>Hash::make($request->password),
            'role'=>'agent',
            'status'=>'active',
        ]);
        $notification = array(
            'message'=>'Agent Created Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.agent')->with($notification);
    }

    public function EditAgent($id)
    {
        $all_agent = User::findOrFail($id);
        return view('backend.agentUser.EditAgent', compact('all_agent'));
    }

    public function UpdateAgent(Request $request)
    {
        $user_id = $request->id;
        User::findOrFail($user_id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);
        $notification = array(
            'message'=>'Agent Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.agent')->with($notification);
    }

    public function DeleteAgent($id)
    {
        User::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Agent Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status Changed Successfully']);
    }

    // Admin User All Method
    public function AllAdmin()
    {
        $all_admin = User::where('role','admin')->get();
        return view('backend.pages.admin.AllAdmin', compact('all_admin'));
    }
}
