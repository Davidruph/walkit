<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Ecodemy WalkIT™</a>
  <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <div class="input-group">

    </div>
  </form>

  <!-- Navbar-->
  <ul class="navbar-nav mr-auto ml-md-0">
    <li class="nav-item">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">
        See Stats
      </button>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto ml-md-0">

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $fullname; ?> &nbsp;<i class="fas fa-user fa-fw"></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="settings.php">Settings</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout">Logout</a>
      </div>
    </li>
  </ul>
</nav>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Home</div>
          <a class="nav-link" href="index.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </a>
          <div class="sb-sidenav-menu-heading">Interface</div>

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Layouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
            User logs
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="Layouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="view-logs.php">View logs</a>
            </nav>
          </div>

        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <?= $role; ?>
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="data">
            <h5>thanks for helping to save the planet!</h5>
            <h5>your walking adds to the total kms saved of:</h3>
              <h4><?= $val ?? '' ?>Kms</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>