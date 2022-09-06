<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LB Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $active == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tools
    </div>

    <li class="nav-item {{ $active == 'psychogram' ? 'active' : '' }}">
        <a class="nav-link" href="/psychogram">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Psikogram</span></a>
    </li>

    <li class="nav-item {{ $active == 'vacancy' ? 'active' : '' }}">
        <a class="nav-link" href="/vacancy">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Lowongan</span></a>
    </li>

    <li class="nav-item {{ str_contains($active, 'master') ? 'active' : '' }}">
        <a class="nav-link {{ str_contains($active, 'master') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#master"
            aria-expanded="true" aria-controls="master">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="master" class="collapse {{ str_contains($active, 'master') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Psikotest :</h6>
                <a class="collapse-item {{ $active == 'master-admin' ? 'active' : '' }}" href="/master/admin">Data Admin</a>
                <a class="collapse-item {{ $active == 'master-user' ? 'active' : '' }}" href="/master/user">Data Pengguna</a>
                <a class="collapse-item {{ $active == 'master-company' ? 'active' : '' }}" href="/master/company">Data Perusahaan</a>
                <a class="collapse-item {{ $active == 'master-psychologist' ? 'active' : '' }}" href="/master/psychologist">Data Psikolog</a>
                <a class="collapse-item {{ $active == 'master-skill' ? 'active' : '' }}" href="/skill/data">Data Kemampuan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ str_contains($active, 'psychotest') ? 'active' : '' }}">
        <a class="nav-link {{ str_contains($active, 'psychotest') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#psikotest"
            aria-expanded="true" aria-controls="psikotest">
            <i class="fas fa-fw fa-cog"></i>
            <span>Psikotest</span>
        </a>
        <div id="psikotest" class="collapse {{ str_contains($active, 'psychotest') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Psikotest :</h6>
                <a class="collapse-item {{ $active == 'psychotest-schedule' ? 'active' : '' }}" href="/psychotest/schedule">Jadwal Psikotest</a>
                <a class="collapse-item {{ $active == 'psychotest-participant' ? 'active' : '' }}" href="/psychotest/participant">Peserta Psikotest</a>
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
<!-- End of Sidebar -->
