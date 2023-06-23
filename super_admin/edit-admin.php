<?php
//db connection included
require 'functions/dbconn.php';

$errors = array();
$success = array();

if (isset($_POST['btnupdate'])) {
  $admin = $_POST['admin'];
  $id = $_POST['edit_id'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $reg_date = date("Y-m-d H:i:s", time());
  $sql = 'UPDATE users SET names=:admin, email=:email, role=:role, registered_on=:reg_date WHERE user_id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':admin' => $admin, ':email' => $email, ':role' => $role, ':reg_date' => $reg_date, ':id' => $id])) {
    $success['data'] = "admin details has been updated successfully <a href='manage-admins'>Go Back</a>";
  } else {
    $errors['data'] = 'Ooops, an error occured';
  }
}

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
    <h1 class="mt-4">Admin</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Edit Admin Page</li>
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

    <div class="col-md-12">
      <div class="card-body">
        <?php
        //if button btn_edit is clicked, save the id of the item and echo it here with a match
        if (isset($_POST['btn_edit'])) {
          $id = $_POST['edit_id'];

          $sql = 'SELECT * FROM users WHERE user_id=:id';
          $statement = $connection->prepare($sql);
          $statement->execute([':id' => $id]);
          $admins = $statement->fetchAll(PDO::FETCH_OBJ);


          foreach ($admins as $admin) {
        ?>

            <form action="edit-admin.php" method="post">
              <input type="hidden" name="edit_id" value="<?= $admin->user_id; ?>">
              <div class="form-group">
                <label class="col-md-2 control-label">Admin Name</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?= $admin->names; ?>" name="admin" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="email" required value="<?= $admin->email; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Role</label>
                <div class="col-md-10">
                  <select name="role" id="" class="form-control">
                    <option value="super_admin" <?php if ($admin->role == 'super_admin') { ?> selected <?php }  ?>>Super Admin</option>
                    <option value="admin" <?php if ($admin->role == 'admin') { ?> selected <?php }  ?>>Admin</option>
                  </select>

                </div>
              </div>


              <a href="manage-admins.php" class="btn btn-danger">Cancel</a>
              <button type="submit" name="btnupdate" class="btn btn-primary">Update</button>

            </form>
        <?php
          }
        }
        ?>

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