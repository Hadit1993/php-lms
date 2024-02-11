@extends('frontend.dashboard.user_dashboard')
@section('user_dashboard')

@php
$profileData = Illuminate\Support\Facades\Auth::user()
@endphp

<div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
    <div class="media media-card align-items-center">
        <div class="media-img media--img media-img-md rounded-full">
            <img class="rounded-full" src="{{(!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_profile.png')}}" alt="Student thumbnail image">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Hello, {{$profileData->name}}</h2>
            
        </div><!-- end media-body -->
    </div><!-- end media -->
   
</div><!-- end breadcrumb-content -->
<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <div class="setting-body">
        
        <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
        <form method="post" class="row pt-40px" action="{{route('user.update.password')}}">
            @csrf
        
       
            <div class="input-box col-lg-6">
                <label class="label-text">Old Password</label>
                <div class="form-group">
                    <input class="form-control form--control @error('old_password') is-invalid @enderror" 
                    type="password" 
                    name="old_password"">
                    <span class="la la-lock input-icon"></span>
                </div>
                @error('old_password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">New Password</label>
                <div class="form-group">
                    <input class="form-control form--control @error('new_password') is-invalid @enderror" 
                    type="password" 
                    name="new_password">
                    <span class="la la-lock input-icon"></span>
                </div>
                @error('new_password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div><!-- end input-box -->
            <div class="input-box col-lg-6">
                <label class="label-text">Confirm New Password</label>
                <div class="form-group">
                    <input class="form-control form--control @error('new_password_confirmation') is-invalid @enderror" 
                    type="password" 
                    name="new_password_confirmation">
                    <span class="la la-lock input-icon"></span>
                </div>
                @error('new_password_confirmation')
                 <span class="text-danger">{{$message}}</span>
                @enderror
            </div><!-- end input-box -->
           
          
            <div class="input-box col-lg-12 py-2">
                <button type="submit" class="btn theme-btn">Save Changes</button>
            </div><!-- end input-box -->
        </form>
    </div><!-- end setting-body -->
</div><!-- end tab-pane -->

@endsection