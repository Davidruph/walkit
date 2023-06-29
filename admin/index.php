<?php
require 'functions/dbconn.php';
?>
<?php
//All header tag to be included
include('include/header.php');
?>

<?php
//sidebar tag to be included
include('include/sidebar.php');
?>

<main>
  <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Participants</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">

                  <?php
                  $count = $connection->prepare("SELECT * FROM data_accumulator WHERE company_user_id = $id");
                  $count->execute();
                  $users = $count->rowCount();
                  echo $users;
                  ?>

                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-green-300 text-dark"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>

<?php
//footer tag to be included
include('include/footer.php');
?>

<?php
//javascripts files to be included
include('include/scripts.php');
?>