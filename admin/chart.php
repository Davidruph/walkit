<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Assuming you have a database connection established
include "../dbconn.php";

// Query the data from the database
$id = $_SESSION['user'];

// Query to retrieve the company name
$companyQuery = "SELECT company_name FROM users WHERE user_id = $id";
$companyResult = mysqli_query($conn, $companyQuery);
$companyRow = mysqli_fetch_assoc($companyResult);
$companyName = $companyRow['company_name'];

// Query to retrieve the data from the data_accumulator table
$dataQuery = "SELECT user_home_address, submitted_on, km_saved, saved_carbon FROM data_accumulator WHERE company_user_id = $id";
$dataResult = mysqli_query($conn, $dataQuery);

// Create an array to store the fetched data
$data = array();

while ($row = mysqli_fetch_assoc($dataResult)) {
    $timestamp = strtotime($row['submitted_on']);
    $date = date('Y-m-d', $timestamp);

    // Add the extracted date and company name to the row data
    $row['submitted_on'] = $date;
    $row['company_name'] = strtoupper($companyName);

    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
