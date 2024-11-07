@extends('layouts.dashboard.app')
@section('title')
    Create contact
@endsection

@section('body')
   <center>
        <div class="card-body shadow mb-4 col-9">
            <h4>Contact : {{$contact->name}}</h2><br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Name : {{ $contact->name }}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value=" Title : {{ $contact->title }}" class="form-control">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Email : {{ $contact->email }}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Phone : {{ $contact->phone }}" class="form-control">

                    </div>
                </div>
            </div>
           
           
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                       <p>{{ $contact->body }}"</p>
                    </div>
                </div>
              
            </div>

           <br>
            {{-- <a href="{{route('admin.contacts.changeStatus' , $contact->id)}}" class="btn btn-primary">{{ $contact->status==1?'Block':'Active' }}</a> --}}
            <a href="mailto:{{$contact->email}}?subject=Re:{{urlencode($contact->title)}}" class="btn btn-primary">Reply <i class="fa fa-reply"></i></a>
            <a href="javascript:void(0)"  onclick="if(confirm('Do you want to delete the contact')){document.getElementById('delete_contact').submit()} return false" class="btn btn-info">Delete <i class="fa fa-trash"></i></a>
        </div>

        <form id="delete_contact" action="{{ route('admin.contacts.destroy' , $contact->id) }}" method="post">
            @csrf
            @method('DELETE')
         </form>
@endsection
