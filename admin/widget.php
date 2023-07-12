<?php
include "../dbconn.php";
if (isset($_GET['ID'])) {
    $user_id = $_GET['ID'];

    $query = "SELECT SUM(saved_carbon) AS total_saved_carbon FROM data_accumulator WHERE company_user_id = $user_id";
    $result = mysqli_query($conn, $query);
    $total = mysqli_fetch_assoc($result);
    $total_saved_carbon = $total['total_saved_carbon'];

    echo $total_saved_carbon;
} else {
    // Handle the case when the user_id parameter is not provided
    echo "Invalid request";
}
