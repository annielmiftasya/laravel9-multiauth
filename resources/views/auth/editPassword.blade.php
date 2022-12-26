@extends('layouts.dashboard')
@section('content')
@include(auth()->user()->type == 'admin'? 'layouts.sidebarAdmin' : 'layouts.sidebar')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   @if(session('success'))
   <p class="alert alert-success">{{ session('success') }}</p>
   @endif
   @if($errors->any())
   @foreach($errors->all() as $err)
   <p class="alert alert-danger">{{ $err }}</p>
   @endforeach
   @endif
   <!-- Main Content -->
   <div id="content">

      @include('layouts.navbar')

      <!-- Begin Page Content -->
      <div class="container-fluid">
         <form action="{{ route('password.action') }}" method="POST">
            @csrf
            <h1>EDIT PASSWORD</h1>
            <div class="form-group">
               <input type="password" class="form-control" name="old_password" required autocomplete="current-password" id="exampleInputPassword" placeholder="Old Password">
            </div>
            <div class="form-group">
               <input type="password" class="form-control" name="new_password" required autocomplete="current-password" id="exampleInputPassword" placeholder=" New Password">
            </div>
            <div class="form-group">
               <input type="password" class="form-control" name="new_password_confirmation" required autocomplete="current-password" id="exampleInputPassword" placeholder="New Password Confirmation">
            </div>
            <div class="mb-3">
               <button class="btn btn-primary">Change</button>
            </div>
         </form>
      </div>
      <!-- /.container-fluid -->

   </div>
   <!-- End of Main Content -->

   <!-- Footer -->
   <footer class="sticky-footer bg-white">
      <div class="container my-auto">
         <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
         </div>
      </div>
   </footer>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
            </form>
         </div>
      </div>
   </div>
</div>
@endsection