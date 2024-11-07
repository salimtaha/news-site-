@extends('layouts.fronend.app')
@section('title')
    Notification
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar' , ['notify_active'=>'active'])



        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('frontend.dashboard.notifications.deleteAll') }}" style="margin-left: 270px" class="btn btn-sm btn-danger">Delete All</a>
                    </div>
                </div>
                @forelse (auth()->user()->notifications as $notify)
                <a href="{{ route('frontend.post.show', $notify->data['post_slug']) }}?notify={{ $notify->id }}">
                    <div class="notification alert alert-info">
                        <strong>You have a notification from: {{ $notify->data['user_name'] }}</strong> Post title:{{ $notify->data['post_title'] }}.<br>
                        {{ $notify->created_at->diffForHumans() }}
                        <div class="float-right">
                            <button onclick="if(confirm('Are u Sure To Delete Notify?')){document.getElementById('deleteNotify').submit()} return false" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>
                <form id="deleteNotify" action="{{ route('frontend.dashboard.notifications.delete') }}" method="post">
                    @csrf
                    <input hidden name="notify_id" value="{{ $notify->id }}">
                </form>
                @empty
                    <div class="alert alert-info">
                        No Notifications yet!
                    </div>

                @endforelse


            </div>
        </div>
    </div>
    <!-- Dashboard End-->
@endsection
