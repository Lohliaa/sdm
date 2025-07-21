<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('home') }}">
        <div class="sidebar-brand-text mx-6"><i class="bi bi-journal-bookmark-fill"></i> KARANGDUREN <span>ARCHIVE</span>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <li class="nav-item">
        <a class="nav-link" href="{{ url('arsip_surat') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Arsip</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('kategori_surat') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Kategori Surat</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('about') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>About</span></a>
    </li>


    @auth
    <!-- Pemisah -->
    <hr class="sidebar-divider d-none d-md-block">

    @if(Auth::check() && Auth::user()->role == 'Admin')
    <div class="sidebar-heading">
        Pengguna
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('profile') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage Account</span>
        </a>
    </li>
    @endif
    @endauth


    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->