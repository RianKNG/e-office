
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Office-PDAM<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Surat</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="surat">Buat Surat</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

              <li class="nav-item">
                <a class="nav-link" href="surat-masuk">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Surat Masuk</span>
                </a>
            </li>

              <li class="nav-item">
                <a class="nav-link" href="#">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                <a class="nav-link" href="notadinas">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Nota Dinas</span>
                </a>
            
                <!-- <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item active" href="blank.html">Blank Page</a>
                    </div>
                </div> -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="disposisi">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Disposisi</span>
                </a>
            </li>
 <li class="nav-item">
                <a class="nav-link" href="backup">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Backup Data</span>
                </a>
            </li>
            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->
             <li class="nav-item">
                <a class="nav-link" href="laporan">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="pengaturan">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
             @if(in_array(Auth::user()->role, ['admin', 'administrator']))
       <li class="nav-item">
                <a class="nav-link" href="admin/users">
                    <!-- aria-controls="collapsePages"> -->
                    <i class="fas fa-fw fa-folder"></i>
                    <span>PP</span>
                </a>
            </li>
    @endif
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>