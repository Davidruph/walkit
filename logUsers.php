<?php
include('dbconn.php');

$ref = $_POST['ref'];
$id = $_POST['user_id'];
$user_address = $_POST['to'];
$km_saved = $_POST['saved_km'];
$saved_carbon = $_POST['saved_carbon'];
$ip = $_POST['ip'];
$device = $_POST['device'];
$os = $_POST['os'];
$browser = $_POST['browser'];

// Sanitize input values
$ref = mysqli_real_escape_string($conn, $ref);
$id = mysqli_real_escape_string($conn, $id);
$user_address = mysqli_real_escape_string($conn, $user_address);
$km_saved = mysqli_real_escape_string($conn, $km_saved);
$ip = mysqli_real_escape_string($conn, $ip);
$device = mysqli_real_escape_string($conn, $device);
$os = mysqli_real_escape_string($conn, $os);
$browser = mysqli_real_escape_string($conn, $browser);
$saved_carbon = mysqli_real_escape_string($conn, $saved_carbon);

// Prepare the SQL statement with parameter binding
$sql = 'INSERT INTO `data_accumulator` (company_user_id, user_home_address, ref, km_saved, saved_carbon, ip, device, os, browser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
$statement = $conn->prepare($sql);
$statement->bind_param('sssssssss', $id, $user_address, $ref, $km_saved, $saved_carbon, $ip, $device, $os, $browser);

// Execute the prepared statement
if ($statement->execute()) {
    // Insertion successful
} else {
    // Insertion failed
}

$statement->close();
$conn->close();
