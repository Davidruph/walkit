<?php
require 'dbconn.php';

$errors = array();
$success = array();

if (isset($_SESSION['user'])) {
  $id = $_SESSION['user'];

  // Update user details
  if (isset($_POST['submit']) && isset($_POST['admin'])) {
    $admin = sanitizeInput($_POST['admin']);
    $email = sanitizeInput($_POST['email']);
    $role = sanitizeInput($_POST['role']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email is invalid";
    } else {
      $sql = 'UPDATE users SET names=:admin, email=:email, role=:role WHERE user_id=:id';
      $statement = $connection->prepare($sql);
      $statement->execute([':admin' => $admin, ':email' => $email, ':role' => $role, ':id' => $id]);

      if ($statement->rowCount() > 0) {
        $success['data'] = "Your details have been updated successfully";
      } else {
        $errors['data'] = 'Oops, an error occurred';
      }
    }
  }

  // Change password
  if (isset($_POST['password_change'])) {
    $old_password = sanitizeInput($_POST['old_password']);
    $new_password = sanitizeInput($_POST['new_password']);

    $statement = $connection->prepare('SELECT * FROM users WHERE user_id = :id');
    $statement->execute([':id' => $id]);

    if ($statement->rowCount() > 0) {
      $row = $statement->fetch();
      $old_pwd = $row['password'];

      if (password_verify($old_password, $old_pwd)) {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $statement = $connection->prepare('UPDATE users SET password = :new_password WHERE user_id = :id');
        $statement->execute([':new_password' => $new_password, ':id' => $id]);

        if ($statement->rowCount() > 0) {
          session_destroy();
          header('Location: ../signin.php');
          exit();
        }
      } else {
        $errors['password'] = "Incorrect password or user does not exist";
      }
    }
  }
}

// Function to sanitize input
function sanitizeInput($input)
{
  $input = trim($input);
  $input = htmlspecialchars($input);
  return $input;
}
