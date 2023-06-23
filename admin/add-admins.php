<?php
include('functions/add_adminsController.php');
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
        <h1 class="mt-4">Admins</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add Admins Page</li>
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

        <div class="card-box">
            <div class="col-md-6">
                <form class="form-horizontal" method="post" autocomplete="off">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Admin Full Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $admin ?? '' ?>" name="admin" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Admin Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" value="<?= $email ?? '' ?>" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Select role</label>
                        <div class="col-md-10">
                            <!-- <input type="email" class="form-control" value="<?= $role ?? '' ?>" name="email" required> -->
                            <select name="role" class="form-control">
                                <option value="super_admin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Admin Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" min="8" value="<?= $code ?? '' ?>" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                        <div class="col-md-10">

                            <button type="submit" class="btn btn-primary btn-block" name="submit">
                                Submit
                            </button>
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