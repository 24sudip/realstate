<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{PropertyType, State};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class StateController extends Controller
{
        public function AllState()
    {
        $state = State::latest()->get();
        return view('backend.state.AllState', compact('state'));
    }

    public function AddState()
    {
        return view('backend.state.AddState');
    }

    public function StoreState(Request $request)
    {
        if ($request->hasFile('state_image')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('state_image')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('state_image'))->resize(370,275);
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/state_images/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/state_images/'.$new_name));
            }
        }
        State::insert([
            'state_name'=>$request->state_name,
            'state_image'=>$new_name,
        ]);
        $notification = array(
            'message'=>'State Created Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.state')->with($notification);
    }

    public function EditState($id)
    {
        $state = State::findOrFail($id);
        return view('backend.state.EditState', compact('state'));
    }

    public function UpdateState(Request $request)
    {
        $state_id = $request->id;
        if ($request->hasFile('state_image')) {
            $manager = new ImageManager(new Driver());
            $img_extension = $request->file('state_image')->getClientOriginalExtension();
            $new_name = hexdec(uniqid()).".".$img_extension;
            $img = $manager->read($request->file('state_image'))->resize(370,275);
            if (file_exists('upload/state_images/'.State::find($state_id)->state_image)) {
                unlink(public_path('upload/state_images/'.State::find($state_id)->state_image));
            }
            if ($img_extension == "png") {
                $img->toPng(80)->save(base_path('public/upload/state_images/'.$new_name));
            } else {
                $img->toJpeg(80)->save(base_path('public/upload/state_images/'.$new_name));
            }
            State::findOrFail($state_id)->update([
                'state_name'=>$request->state_name,
                'state_image'=>$new_name,
            ]);
            $notification = array(
                'message'=>'State Updated With Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.state')->with($notification);
        } else {
            State::findOrFail($state_id)->update([
                'state_name'=>$request->state_name,
            ]);
            $notification = array(
                'message'=>'State Updated Without Image Successfully',
                'alert-type'=>'success',
            );
            return redirect()->route('all.state')->with($notification);
        }
    }

    public function DeleteState($id)
    {
        $state = State::findOrFail($id);
        $img = $state->state_image;
        if (file_exists('upload/state_images/'.$img)) {
            unlink(public_path('upload/state_images/'.$img));
        }
        State::findOrFail($id)->delete();
        $notification = array(
            'message'=>'State Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }
}
