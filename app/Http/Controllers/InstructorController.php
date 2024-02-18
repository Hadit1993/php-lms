<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
   public function InstructorDashboard () {
    return view('instructor.index'); 
   }

   public function InstructorLogout(Request $request) {
      Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
   }

   public function InstructorLogin() {
      return view('instructor.instructor_login');
  }

  public function InstructorProfile() {

      $profileData = Auth::user();
      return view('instructor.instructor_profile_view', compact('profileData'));

  }

  public function InstructorProfileStore(Request $request) 
  {
      /** @var User */
      $data = Auth::user();
      $data->name = $request->name;
      $data->username = $request->username;
      $data->email = $request->email;
      $data->name = $request->name;
      $data->phone = $request->phone;
      $data->address = $request->address;

      if($request->file('photo')) {
          $file = $request->file('photo');
          @unlink(public_path('upload/instructor_images/'.$data->photo));
          $fileName = date('YmdHi').$file->getClientOriginalName();
          $file->move(public_path('upload/instructor_images'), $fileName);
          $data->photo = $fileName;
      }

      $data->save();

      $notification = [
          'message' => 'Admin Profile Updated Successfully',
          'alert-type' => 'success'
      ];

      return redirect()->back()->with($notification);
  
  }

  public function InstructorChangePassword() {
      $profileData = Auth::user();
      return view('instructor.instructor_change_password', compact('profileData'));
  }

  public function InstructorUpdatePassword(Request $request) {

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

  public function InstructorRegister(Request $request) {

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'unique:users']
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->password = Hash::make($request->password);
    $user->role ='instructor';
    $user->save();
    $notification = [
        'message' => 'Instructor registered successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('instructor.login')->with($notification);

  }

 
}