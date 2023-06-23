<?php
include('functions/add_admins_Controller.php');
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
            <div class="col-md-8">
                <form class="form-horizontal" method="post" autocomplete="off" action="add-admins.php">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="full_name">Admin Full Name</label>
                            <input type="text" class="form-control" value="<?= $admin ?? '' ?>" name="admin" required>
                        </div>

                        <div class="col">
                            <label for="full_name">Select role</label>
                            <select name="role" class="form-control">
                                <option value="super_admin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="full_name">Admin Email</label>
                            <input type="email" class="form-control" value="<?= $email ?? '' ?>" name="email" required>
                        </div>

                        <div class="col">
                            <label for="full_name">Admin Password</label>
                            <div class="input-group mb-3" id="show_hide_password">
                                <input type="password" class="form-control" name="password" value="<?= $code ?? '' ?>" required aria-label="password" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block" name="submit">
                                Register
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
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
</script>