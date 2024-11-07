@extends('layouts.dashboard.app')
@section('title')
    Profile
@endsection

@section('body')
    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.profile.update') }}" method="post">
            @csrf
            <div class="card-body shadow mb-4" style="min-width: 100ch">
                <h2>Update Profile</h2><br><br>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{ auth('admin')->user()->name }}" name="name"
                                placeholder="Enter  name" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" value="{{ auth('admin')->user()->username }}" name="username"
                                placeholder="Enter  username" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="{{ auth('admin')->user()->email }}" name="email"
                                placeholder="Enter  email" class="form-control">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" value="" name="password" placeholder="Enter  Password To Confirm"
                                class="form-control">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
<br>
                <button class="btn btn-primary" type="submit">Update Profile</button>
            </div>
    </div>


    </form>
    </div>
@endsection

