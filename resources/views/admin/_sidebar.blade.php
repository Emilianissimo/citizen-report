<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link @if(Route::currentRouteName() === 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Панель
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('social_requests.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'social_requests.')) active @endif">
              <i class="nav-icon fa fa-user-plus"></i>
              <p>
                <b>Обращения</b>
              </p>
            </a>
          </li>
          @if(Auth::user()->is_admin)
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'categories.')) active @endif">
              <i class="nav-icon fa fa-list"></i>
              <p>
                Категории проблем
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('organizations.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'organizations.')) active @endif">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                Организации
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('regions.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'regions.')) active @endif">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                Регионы
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('statuses.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'statuses.')) active @endif">
              <i class="nav-icon fa fa-list"></i>
              <p>
                Статусы обращений
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'users.')) active @endif">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Пользователи
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->is_org_admin)
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'users.')) active @endif">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Пользователи
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('posts.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'posts.')) active @endif">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Посты
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('finances.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'finances.')) active @endif">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Донаты
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->