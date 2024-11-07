@extends('layouts.dashboard.app')
@section('title')
    Users
@endsection
@section('body')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Admin Managment</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Managment</h6>
        </div>

        @include('admin.admins.filter.filter')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                     @forelse ($admins as $admin)
                     <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$admin->name }}</td>
                        <td>{{$admin->username}}</td>
                        <td>{{$admin->email }}</td>
                        <td>{{$admin->status==1? 'Active' : 'Not Active'}}</td>
                        <td>{{$admin->authorization->role}}</td>
                        <td>{{$admin->created_at->format('Y-m-d h:m a')}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="if(confirm('Do you want to delete the admin')){document.getElementById('delete_admin_{{ $admin->id }}').submit()} return false"><i class="fa fa-trash"></i></a>
                            <a href="{{ route('admin.admins.changeStatus', $admin->id) }}"><i class="fa @if($admin->status==1)fa-stop @else fa-play @endif"></i></a>
                            <a href="{{ route('admin.admins.edit' , $admin->id) }}" ><i class="fa fa-edit"></i></a>
                        </td>
                     </tr>

                     <form id="delete_admin_{{$admin->id}}" action="{{ route('admin.admins.destroy' , $admin->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                     </form>
                     @empty
                         <tr>
                            <td class="alert alert-info" colspan="8"> No admins</td>
                         </tr>
                     @endforelse
                    </tbody>
                </table>
                {{ $admins->appends(request()->input())->links() }}
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
