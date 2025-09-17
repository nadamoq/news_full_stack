          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item  @if(str_contains(Route::currentRouteName(),$name)) menu-open @endif">
            <a href="#" class="nav-link @if (Route::currentRouteNamed($name))active
                
            @endif">
              <i class="nav-icon fas fa-profile"></i>
              <p>
                {{$title}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
     <ul class="nav nav-treeview" >

            @foreach ($items as $item)
                       @include('cms.components.aside-menu-item',$item)
            @endforeach

     </ul>
          </li>
       
       
   
