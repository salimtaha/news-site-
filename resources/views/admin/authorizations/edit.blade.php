@extends('layouts.dashboard.app')
@section('title')
    Create Role
@endsection

@section('body')
    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.authorizations.update' , $authorization->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body shadow mb-4" style="min-width: 75ch">
            <div class="row">
                <div class="col-9">
                    <h2> Edit Role</h2>
                </div>
                <div class="col-3">
                    <a href="{{ route('admin.authorizations.index') }}" class="btn btn-primary">Back To Roles</a>
                </div>
            </div><br>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" value="{{ $authorization->role }}" name="role" placeholder="Enter Role Name" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    @foreach (config('authorization.permessions') as  $key=>$value)
                    <div class="col-4">
                        <div class="form-group">
                                {{ $value }} : <input @checked(in_array($key , $authorization->permessions)) value="{{ $key }}" type="checkbox" name="permessions[]">
                        </div>
                    </div>
                    @endforeach
                </div>

               <button type="submit" class="btn btn-primary"> Update Role</button>
            </div>

        </form>
    </div>
@endsection
