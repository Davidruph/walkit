<?php
session_start();
include 'loginController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecodemy WalkIT™ Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <h2 class="text-center text-color mb-0 mt-5 title text-uppercase">Eco<span class="secondary-color">demy</span> WalkIT™</h2>
        <p class="text-center lead subtitle text-color text-uppercase">Active Transit Carbon Calculator</p>
        <h1 class="text-center text-color mt-5 mb-3 text-uppercase">Sign in to Account</h1>
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
        <div class="w-100 shadow trans card">

          <form method="POST" action="signin.php">
            <div class=" form-group mt-4 mr-4 ml-4">
              <label for="Username text-color">Email address</label>
              <input type="text" class="form-control" name="email" value="<?= $email ?? '' ?>" required>
            </div>

            <div class=" form-group mr-4 ml-4">
              <label for="Username text-color">Password</label>
              <div class="input-group" id="show_password">
                <input type="password" class="form-control" name="password" value="<?= $password ?? '' ?>" required aria-label="password" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                </div>
              </div>
            </div>

            <div class="form-group mt-4 mr-4 ml-4">
              <div class="g-recaptcha w-100" data-sitekey="6LeIPcomAAAAAN9lh6br0tx9LBmM-w0XRvvLHUX6"></div>
            </div>

            <div class="form-group mr-4 ml-4">
              <a href="forgot_password" class="float-right">forgot password</a>
              <input type="submit" class="btn login w-100 mt-2 mb-3" name="submit" value="Sign in">
            </div>
          </form>
        </div>
        <div class="trans card w-100 mt-3 shadow">
          <p class="text-center mt-2">New here? <a href="signup">Create an account.</a></p>
        </div>
      </div>
    </div>
  </div>





  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#show_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_password input').attr("type") == "text") {
          $('#show_password input').attr('type', 'password');
          $('#show_password i').addClass("fa-eye-slash");
          $('#show_password i').removeClass("fa-eye");
        } else if ($('#show_password input').attr("type") == "password") {
          $('#show_password input').attr('type', 'text');
          $('#show_password i').removeClass("fa-eye-slash");
          $('#show_password i').addClass("fa-eye");
        }
      });
    });
  </script>
</body>

</html>