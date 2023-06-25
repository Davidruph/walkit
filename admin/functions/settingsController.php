<?php
require 'dbconn.php';

$errors = array();
$success = array();

$id = $_SESSION['user'];
$role =  $_SESSION['role'];

// Update user details
if (isset($_POST['admin_btn'])) {
  $url = sanitizeInput($_POST['url']);
  $name = sanitizeInput($_POST['name']);
  $email = sanitizeInput($_POST['email']);
  $company_name = sanitizeInput($_POST['company_name']);
  $address = sanitizeInput($_POST['address']);
  $country = sanitizeInput($_POST['country']);
  $mobile_code = sanitizeInput($_POST['mobile_code']);
  $mobile = sanitizeInput($_POST['mobile']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email is invalid";
  } else {
    // Generate a unique file name for the logo
    $logoFileName = uniqid('logo_');

    // Check if a logo file was uploaded
    if (isset($_FILES['logo']) && $_FILES['logo']['tmp_name']) {
      $logoFile = $_FILES['logo']['tmp_name'];
      $logoFileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
      $logoFilePath = 'upload/' . $logoFileName . '.' . $logoFileExt;

      move_uploaded_file($logoFile, $logoFilePath);
      $success['data'] = "File has been successfully uploaded";
      $sql = 'UPDATE users SET url=:url, names=:name, email=:email, company_name=:company_name, address=:address, country=:country, mobile_code=:mobile_code, mobile_no=:mobile, logo=:logo WHERE user_id=:id';
      $statement = $connection->prepare($sql);
      $statement->execute([
        ':url' => $url,
        ':name' => $name,
        ':email' => $email,
        ':company_name' => $company_name,
        ':address' => $address,
        ':country' => $country,
        ':mobile_code' => $mobile_code,
        ':mobile' => $mobile,
        ':logo' => $logoFilePath, // Use the file path in the query
        ':id' => $id
      ]);

      if ($statement->rowCount() > 0) {
        $success['data'] = "Your details have been updated successfully";
      } else {
        $errors['data'] = 'Oops, an error occurred';
      }
    } else {
      $sql = 'UPDATE users SET url=:url, names=:name, email=:email, company_name=:company_name, address=:address, country=:country, mobile_code=:mobile_code, mobile_no=:mobile WHERE user_id=:id';
      $statement = $connection->prepare($sql);
      $statement->execute([
        ':url' => $url,
        ':name' => $name,
        ':email' => $email,
        ':company_name' => $company_name,
        ':address' => $address,
        ':country' => $country,
        ':mobile_code' => $mobile_code,
        ':mobile' => $mobile,
        ':id' => $id
      ]);

      if ($statement->rowCount() > 0) {
        $success['data'] = "Your details have been updated successfully";
      } else {
        $errors['data'] = 'Oops, an error occurred';
      }
    }
  }
}


// Change password
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


// Function to sanitize input
function sanitizeInput($input)
{
  $input = trim($input);
  $input = htmlspecialchars($input);
  return $input;
}
