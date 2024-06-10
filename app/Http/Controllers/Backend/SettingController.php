<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;

class SettingController extends Controller
{
    public function SmtpSetting() {
        $setting = SmtpSetting::find(1);
        return view('backend.setting.SmtpUpdate', compact('setting'));
    }

    public function UpdateSmtpSetting(Request $request) {
        $smtp_id = $request->id;
        SmtpSetting::findOrFail($smtp_id)->update([
            'mailer'=>$request->mailer,
            'host'=>$request->host,
            'port'=>$request->port,
            'user_name'=>$request->user_name,
            'password'=>$request->password,
            'encryption'=>$request->encryption,
            'from_address'=>$request->from_address,
            'updated_at'=>now(),
        ]);
        $notification = array(
            'message'=>'Smtp Setting Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }
}
