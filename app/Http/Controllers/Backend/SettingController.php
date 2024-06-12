<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{SmtpSetting, SiteSetting};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

    public function SiteSetting() {
        $site_setting = SiteSetting::find(1);
        return view('backend.setting.SiteUpdate', compact('site_setting'));
    }

    public function UpdateSiteSetting(Request $request)
    {
        $site_id = $request->id;
        if ($request->hasFile('logo')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('logo')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            // $img = @imagecreatefrompng($request->file('logo'));
            $img = $manager->read($request->file('logo'))->resize(1500,386);
            if (file_exists('upload/logo/'.SiteSetting::find($site_id)->logo)) {
                unlink(public_path('upload/logo/'.SiteSetting::find($site_id)->logo));
            }
            // $img->save(base_path('public/upload/logo/'.$new_name));
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/logo/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/logo/'.$new_name));
            }
            SiteSetting::findOrFail($site_id)->update([
                'support_phone'=>$request->support_phone,
                'company_address'=>$request->company_address,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'copyright'=>$request->copyright,
                'logo'=>$new_name,
            ]);
            $notification = array(
                'message'=>'SiteSetting Updated With Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        } else {
            SiteSetting::findOrFail($site_id)->update([
                'support_phone'=>$request->support_phone,
                'company_address'=>$request->company_address,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'copyright'=>$request->copyright,
            ]);
            $notification = array(
                'message'=>'SiteSetting Updated Without Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
