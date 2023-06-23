<?php
include('dbconn.php');

$ref = $_POST['ref'];
$id = $_POST['user_id'];
$user_address = $_POST['to'];
$km_saved = $_POST['saved_km'];
$ip = $_POST['ip'];
$device = $_POST['device'];
$os = $_POST['os'];
$browser = $_POST['browser'];
$submitted_on = date("Y-m-d H:i:s", time());
$sql = mysqli_query($conn, "INSERT INTO `data_accumulator` (company_user_id, user_home_address, ref, km_saved, ip, device, os, browser, submitted_on) VALUES('$id','$user_address','$ref','$km_saved','$ip','$device','$os','$browser','$submitted_on')");
