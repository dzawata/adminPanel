<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ (request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*')) ? 'active' : '' }}">
        <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
            <i class="fas fa-fw fa-users"></i>
            <span>User Administration</span>
        </a>
        <div id="collapse1" class="collapse {{ (request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*')) ? 'show' : '' }}" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                <a class="collapse-item {{ request()->is('admin/roles*') ? 'active' : '' }}" href="{{ route('roles') }}">Roles</a>
                <a class="collapse-item {{ request()->is('admin/permissions*') ? 'active' : '' }}" href="{{ route('permissions') }}">Permissions</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->is('admin/menus*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('menus') }}">
            <i class="fas fa-fw fa-link"></i>
            <span>Menus</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('remove-cache') }}">Clears Cache</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>