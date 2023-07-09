<?php
session_start();
// Assuming you have a database connection established
include "../dbconn.php";

// Query the data from the database
$id = $_SESSION['user'];
$query = "SELECT user_home_address, submitted_on, km_saved, saved_carbon FROM data_accumulator WHERE company_user_id = $id";
$result = mysqli_query($conn, $query);

// Create an array to store the fetched data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $timestamp = strtotime($row['submitted_on']);
    $date = date('Y-m-d', $timestamp);

    // Add the extracted date to the row data
    $row['submitted_on'] = $date;

    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
