<?php
require 'dbconn.php';

$errors = array();
$success = array();

$id = $_SESSION['user'];

// Update user details
if (isset($_POST['update_btn'])) {
  $name = sanitizeInput($_POST['name']);
  $email = sanitizeInput($_POST['email']);
  $role = sanitizeInput($_POST['role']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email is invalid";
  } else {
    $sql = 'UPDATE users SET names=:name, email=:email, role=:role WHERE user_id=:id';
    $statement = $connection->prepare($sql);
    $statement->execute([':name' => $name, ':email' => $email, ':role' => $role, ':id' => $id]);

    if ($statement->rowCount() > 0) {
      $success['data'] = "Your details have been updated successfully";
    } else {
      $errors['data'] = 'Oops, an error occurred';
    }
  }
}

if (isset($_POST['btn_password'])) {
  $old_password = sanitizeInput($_POST['old_password']);
  $new_password = sanitizeInput($_POST['new_password']);

  $statement = $connection->prepare('SELECT password FROM users WHERE user_id = :id');
  $statement->execute([':id' => $id]);

  $user = $statement->fetch();

  if ($user && password_verify($old_password, $user['password'])) {
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $statement = $connection->prepare('UPDATE users SET password = :new_password WHERE user_id = :id');
    $statement->execute([':new_password' => $new_password_hash, ':id' => $id]);

    if ($statement->rowCount() > 0) {
      session_destroy();
      header('Location: ../signin');
      exit();
    }
  } else {
    $errors['password'] = "Incorrect password or user does not exist";
  }
}

function sanitizeInput($input)
{
  $input = trim($input);
  $input = htmlspecialchars($input);
  return $input;
}
