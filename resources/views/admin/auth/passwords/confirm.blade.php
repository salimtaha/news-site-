@extends('layouts.dashboard.auth.app')
@section('title')
    Confirm
@endsection

@section('body')
  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Enter Your Verfication code!</h1>
                            </div>
                            <form action="{{ route('admin.password.verifyOtp') }}" method="post" class="user">
                                @csrf
                                <div class="form-group">
                                    <input hidden name="email" type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                       value="{{ $email }}">

                                        @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input name="token" type="text" class="form-control form-control-user"
                                        id="exampleInputtoken" placeholder="token">
                                        @error('token')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Check Token
                                </button>
                                <hr>
                            </form>
                            <hr>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
