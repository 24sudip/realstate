<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AgentController extends Controller
{
    public function AgentDashboard()
    {
        return view('agent.index');
    }

    public function AgentLogin()
    {
        return view('agent.AgentLogin');
    }

    public function AgentRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'password' => Hash::make($request->password),
            'role'=>'agent',
            'status'=>'inactive',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);
    }

    public function AgentLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'Agent LogOut Successfully',
            'alert-type'=>'success',
        );

        return redirect(route('agent.login'))->with($notification);
    }

    public function AgentProfile()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('agent.AgentProfileView', compact('profile_data'));
    }

        public function AgentProfileStore(Request $request)
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
            @unlink(public_path('upload/agent_photos/'.$data->photo));
            $file_name = date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_photos'),$file_name);
            $data['photo'] = $file_name;
        }
        $data->save();
        $notification = array(
            'message'=>'Agent Profile Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function AgentChangePassword()
    {
        $id = Auth::user()->id;
        $profile_data = User::find($id);
        return view('agent.AgentChangePassword', compact('profile_data'));
    }

    public function AgentUpdatePassword(Request $request)
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
}
