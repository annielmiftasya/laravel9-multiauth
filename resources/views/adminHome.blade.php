@extends('layouts.dashboard')
@section('content')
@include('layouts.sidebarAdmin')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        @include('layouts.navbar')


        <!-- Begin Page Content -->
        <div class="container-fluid">
            @yield('contentData')
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->

</div>

@endsection