<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard|@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    {{-- file input --}}
    <link href="{{ asset('assets/vendor/file-input/css/fileinput.min.css') }}" rel="stylesheet">

    {{-- summernote --}}
    <link href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet">

    @stack('css')
    @livewireStyles

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       @include('layouts.dashboard.sidebar')

        <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
             @include('layouts.dashboard.header')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
             @yield('body')
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
<br>

        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @auth
        <script>
            role = "admin";
            adminId= "{{ auth('admin')->user()->id }}";
        </script>
       @endauth
       <script src="{{ asset('build/assets/app-BZyn1xdC.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/admin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/admin') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/admin') }}/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('assets/admin') }}/js/demo/chart-pie-demo.js"></script>

        {{-- file input --}}
        <script src="{{ asset('assets/vendor/file-input/js/fileinput.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/file-input/themes/fa5/theme.min.js') }}"></script>

        {{-- summernote --}}
        <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
        @stack('js')
        @livewireScripts

</body>

</html>
