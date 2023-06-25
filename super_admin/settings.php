<?php
//All header tag to be included
include('include/header.php');
?>

<?php
include('functions/settingsController.php');
?>


<?php
//sidebar tag to be included
include('include/sidebar.php');
?>


<main>
  <div class="container-fluid">
    <h1 class="mt-4">Settings</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Settings Page</li>
    </ol>
    <!-- if there is an error, echo all of them -->
    <?php if (count($errors) > 0) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php foreach ($errors as $error) : ?>
          <li style="color: red"><?php echo $error; ?></li>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- if there is success, echo all of them -->
    <?php if (count($success) > 0) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php foreach ($success as $succes) : ?>
          <li style="color: green"><?php echo $succes; ?></li>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php
    $qry = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$id'");
    if (mysqli_num_rows($qry) > 0) {
      $row = mysqli_fetch_array($qry);
      $name = $row['names'];
      $email = $row['email'];
      $role = $row['role'];
    }
    ?>

    <div class="card-box">
      <div class="col-md-12">
        <form class="form-horizontal" method="post" autocomplete="off" action="settings.php">

          <div class="row mb-3">
            <div class="col">
              <label for="full_name">Full Name</label>
              <input type="text" class="form-control" value="<?= $name ?>" name="name" required>
            </div>

            <div class="col">
              <label for="full_name">Email</label>
              <input type="email" class="form-control" value="<?= $email ?>" name="email" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="full_name">Change role</label>
              <select name="role" id="" class="form-control">
                <option value="">select role</option>
                <option value="super_admin" <?php if ($role == 'super_admin') { ?> selected <?php }  ?>>Super Admin</option>
                <option value="admin" <?php if ($role == 'admin') { ?> selected <?php }  ?>>Admin</option>
              </select>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col">
              <button type="submit" class="btn text-white btn-block" name="update_btn">
                Update
              </button>
            </div>
          </div>

          <hr class="mt-5 mb-4 border-dark">
          <p>
            <a class="btn text-white" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Change Password
            </a>
          </p>
          <div class="collapse mb-5" id="collapseExample">
            <div class="card card-body">
              <div class="row mb-3">
                <div class="col">
                  <label for="exampleFormControlFile1">Old Password</label>
                  <input type="password" class="form-control" name="old_password" id="">
                </div>

                <div class="col">
                  <label for="exampleFormControlFile1">New Password</label>
                  <input type="password" class="form-control" name="new_password" id="">
                </div>
              </div>

              <button type="submit" name="password_change" class="btn text-white">Change Password</button>
            </div>
          </div>

        </form>
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