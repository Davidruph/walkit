<?php
session_start();
//   $conn = mysqli_connect("localhost", "ujcjwhfeokxbh", "#i@|d4}sj3(1", "dbjqx4xsyvob6y");
$conn = mysqli_connect("localhost", "root", "", "walkit_app");

if (!isset($_SESSION['email'])) {
    header("Location: ../signin");
    exit();
} else {

    $id = $_SESSION['user'];
    $fullname = $_SESSION['fullname'];
    $mobile = $_SESSION['mobile'];
    $country = $_SESSION['country'];
    $role = $_SESSION['role'];
    $user_email = $_SESSION['email'];

    //select the sum of all km saved by user
    $sql = mysqli_query($conn, "SELECT sum(km_saved) FROM data_accumulator WHERE company_user_id = $id");

    //get values of rows
    while ($row = mysqli_fetch_array($sql)) {

        //extract just the float numbers excluding the strings
        $val = (float) filter_var($row[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        //display values
        echo $val . "<br>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ecodemy WalkIT™ Admin</title>

    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/custom-css.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="assets/js/all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .icon {
            width: 16px;
            height: 16px;
            padding: 0;
            margin: 0;
            vertical-align: middle;
        }
    </style>

</head>

<body class="sb-nav-fixed">