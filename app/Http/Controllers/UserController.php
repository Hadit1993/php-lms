<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function Index() {

        return view('frontend.index');
    }

    public function UserProfile() {
        
        $profileData = Auth::user();
        
        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }
}