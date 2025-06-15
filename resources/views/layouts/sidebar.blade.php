<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.' . auth()->user()->role) }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HypeNews</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.' . auth()->user()->role) }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Konten
    </div>

    <!-- Nav Item - Berita -->
    <li class="nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('berita.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Berita</span>
        </a>
    </li>

    @if(auth()->user()->isAdmin())
    <!-- Nav Item - Kategori (Admin only) -->
    <li class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kategori</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Akun
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
