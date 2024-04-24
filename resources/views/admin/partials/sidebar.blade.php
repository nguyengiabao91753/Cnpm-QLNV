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
        <img src="{{ asset('administrator/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
    </div>

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
            <li class="nav-item @yield('sta')">
            <a href="{{route('admin./')}}" class="nav-link @yield('sta-info')">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                Statistical
                
                </p>
            </a>
            <!-- <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.employee.index')}}" class="nav-link @yield('emp-info')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Information</p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="" class="nav-link @yield('emp-acc')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=" {{route('admin.employee.create')}} " class="nav-link @yield('emp-create')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                    </a>
                </li>
            </ul> -->
        </li>
        <li class="nav-item @yield('emp')">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                Employee
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.employee.index')}}" class="nav-link @yield('emp-info')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Information</p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{route('admin.account.index')}}" class="nav-link @yield('emp-acc')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=" {{route('admin.employee.create')}} " class="nav-link @yield('emp-create')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item @yield('sch')">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>
                Work Schedule
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.schedule.create')}}" class="nav-link @yield('sch-create')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{route('admin.schedule.index')}}" class="nav-link @yield('sch-list')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item @yield('att')">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Attendance
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.attendance.request')}}" class="nav-link @yield('att-request')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Leave Request</p>
                    </a>
                    </li>
                <li class="nav-item">
                    <a href="{{route('admin.attendance.index')}}" class="nav-link @yield('att-list')">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
