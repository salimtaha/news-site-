  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">{{ config('app.name') }}<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      @can('home')
          <li class="nav-item active">
              <a class="nav-link" href="{{ route('admin.home') }}">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
          </li>
      @endcan

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Interface
      </div>
      <!-- Nav Item - Admin managments -->
      @can('admins')
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminManagment"
                  aria-expanded="true" aria-controls="adminManagment">
                  <i class="fas fa-user fa-user"></i>
                  <span>Admins</span>
              </a>
              <div id="adminManagment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Admins managment:</h6>
                      <a class="collapse-item" href="{{ route('admin.admins.index') }}">Admins</a>
                      <a class="collapse-item" href="{{ route('admin.admins.create') }}">Add New Admin</a>
                  </div>
              </div>
          </li>
      @endcan

         <!-- Nav Item -Authorization -->
         @can('authorizations')
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#authorizationManagent"
                 aria-expanded="true" aria-controls="authorizationManagent">
                 <i class="fas fa-fw fa-wrench"></i>
                 <span>Authorization</span>
             </a>
             <div id="authorizationManagent" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">Authorization managment:</h6>
                     <a class="collapse-item" href="{{ route('admin.authorizations.index') }}">Roles</a>
                     <a class="collapse-item" href="{{ route('admin.authorizations.create') }}"> Create Role</a>
                 </div>
             </div>
         </li>
     @endcan
       <!-- Nav Item - Pages Collapse Menu -->
       @can('users')
       <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
               <i class="fas fa-fw fa-users"></i>
               <span>User Management</span>
           </a>
           <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                   <a class="collapse-item" href="{{ route('admin.users.index') }}">Users</a>
                   <a class="collapse-item" href="{{ route('admin.users.create') }}">Add User</a>
               </div>
           </div>
       </li>
   @endcan
   @can('categories')
   <li class="nav-item">
       <a class="nav-link" href="{{ route('admin.categories.index') }}">
           <i class="fas fa-fw fa-table"></i>
           <span>Categories</span></a>
   </li>
@endcan

      <!-- Nav Item - Pages Collapse Menu -->
      @can('posts')
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-folder fa-cog"></i>
                  <span>Post Managment</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">posts managment:</h6>
                      <a class="collapse-item" href="{{ route('admin.posts.index') }}">Posts</a>
                      <a class="collapse-item" href="{{ route('admin.posts.create') }}">Create Post</a>
                  </div>
              </div>
          </li>
      @endcan
      <!-- Nav Item - Utilities Collapse Menu -->






      <!-- Divider -->
      <hr class="sidebar-divider">


      @can('settings')
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
              aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Setting</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">setting managment:</h6>
                  <a class="collapse-item" href="{{ route('admin.settings.index') }}">Setting</a>
                  <a class="collapse-item" href="{{ route('admin.related-site.index') }}">Related Sites</a>
              </div>
          </div>
      </li>
  @endcan


      @can('contacts')
      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.contacts.index') }}">
              <i class="fas fa-fw fa-phone"></i>
              <span>Contacts</span></a>
      </li>
      @endcan
      @can('notifications')
      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.notifications.index') }}">
              <i class="fas fa-fw fa-table"></i>
              <span>Notifications</span></a>
      </li>
      @endcan

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>



  </ul>
  <!-- End of Sidebar -->
