              <li class="nav-item">
                <a href="{{route($item['route'])}}" 
                class="nav-link @if (Route::currentRouteNamed($item['route']))active
                    
                @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{$item['name']}}</p>
                </a>
              </li>
          
           