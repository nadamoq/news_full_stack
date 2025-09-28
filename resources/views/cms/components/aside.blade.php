 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('cms/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin Panel</a>
        </div>
      </div>
        <!-- Brand Logo -->
    <a href="{{route('user-view.index')}}" class="brand-link">
      <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">User view</span>
    </a>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @include('cms.components.aside-menu',[
          'title'=>'users',
          'name'=>'users',
          'items'=>
          [
          ['name'=>'read','route'=>'users.index'],
          ['name'=>'create','route'=>'users.create']
          ]
            
          ])
        </ul>
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @include('cms.components.aside-menu',[
          'title'=>'news',
          'name'=>'news',
          'items'=>
          [
          ['name'=>'read','route'=>'news.index'],
          ['name'=>'create','route'=>'news.create']
          ]
            
          ])
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @include('cms.components.aside-menu',[
          'title'=>'contacts',
          'name'=>'contact',
          'items'=>
          [
          ['name'=>'read','route'=>'contact.index']
          
          ]
            
          ])
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" style="list-style: none;  ">
        <li class="nav-header">Settings</li>
       
         <li class="nav-item">
          <a href='{{route('auth.resetPassword')}}'class='nav-link'>Change password</a>
        </li>

         <li class="nav-item">
          <a href='{{route('auth.logout')}}'class='nav-link'><p>Logout</p></a>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>