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

        $userId = Auth::user()-> id;
        $profileData = User::find($userId);
        return view('admin.admin_profile_view', compact('profileData'));

    }

    public function AdminProfileStore(Request $request) {

        $userId = Auth::user()->id;
        $data = User::find($userId);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data->photo = $fileName;
        }

        $data->save();

        return redirect() -> back();
    
    }
}