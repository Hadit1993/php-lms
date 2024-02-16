<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function Index(): View
    {

        return view('frontend.index');
    }

    public function UserProfile(): View {

        $profileData = Auth::user();

        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }

    public function UserProfileUpdate(Request $request): RedirectResponse
    {
        /** @var User $data */
        $data = Auth::user();
        // $data = User::find($userId);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $data->photo = $fileName;
        }

        $data->save();

        $notification = [
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function UserLogout(Request $request) {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function UserChangePassword() {

        return view('frontend.dashboard.change_password');
    }

    public function UserUpdatePassword(Request $request) {

        /** @var User */
          $user = Auth::user();

          $request->validate([
              'old_password' => 'required',
              'new_password' => 'required|confirmed'
          ]);

          if (!Hash::check($request->old_password, $user->password)) {
              $notification = [
                  'message' => 'Old password does not match!',
                  'alert-type' => 'error'
              ];

              return back()->with($notification);
          }

          $user->update([
              'password' => Hash::make($request->new_password)
          ]);


          $notification = [
              'message' => 'Password changed successfully',
              'alert-type' => 'success'
          ];

          return back()->with($notification);
    }
}
