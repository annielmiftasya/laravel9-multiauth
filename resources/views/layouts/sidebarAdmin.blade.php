  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
           <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin<sup>2</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
           <i class="fas fa-fw fa-cog"></i>
           <span>Category</span>
        </a>
     </li>

     <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">
           <i class="fas fa-fw fa-wrench"></i>
           <span>Posts</span>
        </a>
     </li>

  </ul>
  <!-- End of Sidebar -->