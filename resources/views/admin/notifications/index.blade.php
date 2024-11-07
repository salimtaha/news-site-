@extends('layouts.dashboard.app')
@section('title')
    Notification
@endsection
@section('body')
       {{-- show comments --}}
       <div class="d-flex justify-content-center">

        <!-- Main Content -->
        <div class="card-body shadow mb-4" style="max-width: 100ch">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                       <a href="{{route('admin.notifications.deleteAll')}}" class="btn btn-danger" style="margin-left: 33ch">Delete All</a>
                    </div>

                </div>
                @forelse ($notifications as $notify)
                <div class="notification alert alert-info">
                    <strong><img src="" width="50px" class="img-thumbnial rounded"> <a style="text-decoration: none" href="{{ $notify->data['link'] }}?notify_admin={{ $notify->id }}">{{ $notify->data['user_name'] }}</a> : </strong> {{ $notify->data['contact_title'] }}.<br>
                    <strong style="color: red"> {{ $notify->created_at->diffForHumans() }}</strong>
                    <div class="float-right">
                        <a href="{{ route('admin.notifications.destroy' , $notify->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>
                @empty
                       <div class="alert alert-info">
                        No Comments yet!
                    </div>
                @endforelse


            </div>
        </div>
    </div>
@endsection
