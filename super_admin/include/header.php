<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../signin");
} else {

    $id = $_SESSION['user'];
    $fullname = $_SESSION['fullname'];
    $mobile = $_SESSION['mobile'];
    $country = $_SESSION['country'];
    $role = $_SESSION['role'];
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
    <title>Ecodemy WalkIT™ Super Admin</title>

    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/custom-css.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="assets/js/all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

</head>

<body class="sb-nav-fixed">