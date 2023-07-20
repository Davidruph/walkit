<?php
include "../dbconn.php";

if (isset($_GET['ID'])) {
    $user_id = $_GET['ID'];

    $query = "SELECT saved_carbon FROM data_accumulator WHERE company_user_id = $user_id";
    $result = mysqli_query($conn, $query);

    $total_saved_carbon_kg = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $saved_carbon = $row['saved_carbon'];
        preg_match('/^([\d.]+)\s*(kg|g)$/', $saved_carbon, $matches);

        if (count($matches) === 3) {
            $value = (float) $matches[1];
            $unit = $matches[2];

            if ($unit === 'kg') {
                $total_saved_carbon_kg += $value;
            } elseif ($unit === 'g') {
                $total_saved_carbon_kg += ($value / 1000); // Convert grams to kilograms
            }
        }
    }

    // Convert the total saved carbon to a whole number
    $total_saved_carbon_whole = round($total_saved_carbon_kg);

    echo $total_saved_carbon_whole;
} else {
    // Handle the case when the user_id parameter is not provided
    echo "Invalid request";
}
