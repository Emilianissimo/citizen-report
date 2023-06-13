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
            <a href="{{route('requests.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'requests.')) active @endif">
              <i class="nav-icon fa fa-list"></i>
              <p>
                <b>Обращения</b>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('categories.index')}}" class="nav-link @if(Str::startsWith(Route::currentRouteName(), 'categories.')) active @endif">
              <i class="nav-icon fa fa-list"></i>
              <p>
                Категории проблем
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
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->