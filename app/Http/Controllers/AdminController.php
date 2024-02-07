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
}