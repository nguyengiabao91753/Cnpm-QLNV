<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('administrator/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Project Laravel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @php
                    $emp = DB::table('employees')->find(Auth::guard('client')->id());
                @endphp
                <img src="{{ asset('uploads/' .$emp->image ) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$emp->name}}</a>
            </div>
        </div>
        @if (Auth::guard('client')->check())
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="col-md-12" style="text-align: center;">
                <a href="{{route('logout',['guard'=> 'client'])}}" class="btn btn-block btn-outline-danger"><i class="fas fa-power-off"></i> Logout</a>
            </div>

        </div>
        @endif

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                <li class="nav-item @yield('profile')">
                    <a href="{{route('profile')}}" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

                <li class="nav-item @yield('sch')">
                    <a href="{{route('schedule')}}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Work Schedule

                        </p>
                    </a>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>