@extends('layouts.dashboard.app')
@section('title')
    Create User
@endsection

@section('body')
   <center>
    <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body shadow mb-4 col-10">
            <h2>Create New User</h2><br><br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Enter User name" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter User Username" class="form-control">
                        @error('username')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Enter User Email" class="form-control">
                        @error('email')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Enter User Phone" class="form-control">
                        @error('phone')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('status')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select name="email_verified_at" class="form-control">
                            <option selected disabled>Select Email Status</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @error('email_verified_at')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="country" placeholder="Enter Country Name" class="form-control">
                        @error('country')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="city" placeholder="Enter City Name" class="form-control">
                        @error('city')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="street" placeholder="Enter Street name" class="form-control">
                        @error('street')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="file" name="image" class="form-control">
                        @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter Password" class="form-control">
                        @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="Enter Password again"
                            class="form-control">
                    </div>
                </div>
            </div><br>
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>

    </form>
   </center>
@endsection
