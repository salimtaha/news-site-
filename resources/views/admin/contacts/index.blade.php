@extends('layouts.dashboard.app')
@section('title')
    contacts
@endsection
@section('body')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Contact Table</h1>
   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contact managment</h6>
        </div>

        @include('admin.contacts.filter.filter')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>title</th>
                            <th>Status</th>
                            <th>phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>title</th>
                            <th>Status</th>
                            <th>phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                     @forelse ($contacts as $contact)
                     <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$contact->name }}</td>
                        <td>{{$contact->email }}</td>
                        <td>{{$contact->title}}</td>
                        <td>{{$contact->status==0? 'unread': 'read'}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="if(confirm('Do you want to delete the contact')){document.getElementById('delete_contact_{{ $contact->id }}').submit()} return false"><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.contacts.show' , $contact->id) }}" ><i class="fa fa-eye"></i></a>
                        </td>
                     </tr>

                     <form id="delete_contact_{{$contact->id}}" action="{{ route('admin.contacts.destroy' , $contact->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                     </form>
                     @empty
                         <tr>
                            <tdv class="alert alert-info" colspan="6"> No contacts</td>
                         </tr>
                     @endforelse
                    </tbody>
                </table>
                {{ $contacts->appends(request()->input())->links() }}
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
