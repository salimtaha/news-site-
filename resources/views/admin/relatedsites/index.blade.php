@extends('layouts.dashboard.app')
@section('title')
    R-Sites
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Related Sites</h1>
        <p class="mb-4">DataTables is a third party plugin that is </a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Related Sites Managment</h6>
            </div>

            {{-- table data --}}
            <div class="card-body">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#add-site">Add Related Site</a>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($sites as $site)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $site->name }}</td>
                                    <td>{{ $site->url }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Do you want to delete the site')){document.getElementById('delete_site_{{ $site->id }}').submit()} return false"><i
                                                class="fa fa-trash"></i></a>

                                        <a href="javascript:void(0)"><i class="fa fa-edit" data-toggle="modal"
                                                data-target="#edit-site-{{ $site->id }}"></i></a>
                                    </td>
                                </tr>

                                <form id="delete_site_{{ $site->id }}"
                                    action="{{ route('admin.related-site.destroy', $site->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                {{-- edit site modal --}}
                                @include('admin.relatedsites.edit')
                                {{-- end edit site modal --}}
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> No Sites</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $sites->links() }}
                </div>

            </div>
        </div>

        {{-- modal add new site --}}
        @include('admin.relatedsites.create')
    </div>
    <!-- /.container-fluid -->
@endsection
