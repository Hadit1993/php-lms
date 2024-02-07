<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard() {

        return view('admin.index'); 
    }

    public function AdminLogout(Request $request)
    
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


    public function AdminLogin() {
        return view('admin.admin_login');
    }

    public function AdminProfile() {

        $profileData = Auth::user();
       
        // dd($profileData);
        return view('admin.admin_profile_view', compact('profileData'));

    }

    public function AdminProfileStore(Request $request) 
    {
        /** @var User */
        $data = Auth::user();
        // $data = User::find($userId);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data->photo = $fileName;
        }

        $data->save();

        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    
    }
}