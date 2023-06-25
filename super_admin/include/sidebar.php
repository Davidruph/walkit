<nav class="sb-topnav navbar navbar-expand bg-menu">
    <a class="navbar-brand title text-white" href="index.php">Ecodemy WalkIT™</a>
    <button class="btn text-white border btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">

        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle text-white" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $fullname; ?> &nbsp;<i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="settings.php">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav" class="bg-sidebar">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu bg-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link" href="index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>


                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Layouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                        Admins
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Layouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="add-admins">Add Admins</a>
                            <a class="nav-link" href="manage-admins">Manage Admins</a>
                        </nav>
                    </div>


                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coll" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users fa-fw"></i></div>
                        Mail Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="coll" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="single">Single Users</a>
                            <a class="nav-link" href="all">Mail all Users</a>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="sb-sidenav-footer bg-menu">
                <div class="small">Logged in as:</div>
                Super Admin
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">