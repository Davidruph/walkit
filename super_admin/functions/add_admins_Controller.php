<?php
require 'dbconn.php';

$errors = array();
$success = array();

if (isset($_POST['submit']) && isset($_POST['admin'])) {
  $admin = sanitizeInput($_POST['admin']);
  $email = sanitizeInput($_POST['email']);
  $password = sanitizeInput($_POST['password']);
  $reg_date = date("Y-m-d H:i:s", time());
  $role = sanitizeInput($_POST['role']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email is invalid";
  } elseif (strlen($password) < 8) {
    $errors['password'] = "Password is too short";
  } else {
    $statement = $connection->prepare('SELECT email FROM users WHERE email=:email');
    $statement->execute([':email' => $email]);

    if ($statement->rowCount() > 0) {
      $errors['email'] = "Email already exists";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $statement = $connection->prepare('INSERT INTO users(names, password, email, role, registered_on) VALUES(:admin, :password, :email, :role, :reg_date)');
      $statement->execute([':admin' => $admin, ':password' => $hashedPassword, ':email' => $email, ':role' => $role, ':reg_date' => $reg_date]);

      if ($statement->rowCount() > 0) {
        $success['data'] = 'Admin registered successfully';
      } else {
        $errors['data'] = 'Oops, an error occurred';
      }
    }
  }
}

// Function to sanitize input
function sanitizeInput($input) {
  $input = trim($input);
  $input = htmlspecialchars($input);
  return $input;
}
