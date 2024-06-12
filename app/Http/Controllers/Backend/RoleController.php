<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission() {
        $permissions = Permission::all();
        return view('backend.pages.permission.AllPermission', compact('permissions'));
    }

    public function AddPermission() {
        return view('backend.pages.permission.AddPermission');
    }

    public function StorePermission(Request $request) {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name'=>$request->group_name,
        ]);
        $notification = array(
            'message'=>'Permission Created Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id) {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.EditPermission', compact('permission'));
    }

    public function UpdatePermission(Request $request) {
        $per_id = $request->id;
        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name'=>$request->group_name,
        ]);
        $notification = array(
            'message'=>'Permission Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('all.permission')->with($notification);
        }

    public function DeletePermission($id) {
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Permission Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }
}
