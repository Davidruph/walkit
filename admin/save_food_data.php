<?php
require "functions/dbconn.php";

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the POST data
    $total = $_POST['total'];
    $selectedOptions = $_POST['selectedOptions'];
    $user_id = $_POST['user_id'];

    try {
        // Prepare an SQL statement
        $stmt = $connection->prepare("INSERT INTO packit (total, selected_option, user_id) VALUES (:total, :selectedOptions, :user_id)");

        // Bind the parameters to the SQL query
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':selectedOptions', $selectedOptions);
        $stmt->bindParam(':user_id', $user_id);

        // Execute the SQL statement
        $stmt->execute();
        echo "success";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request";
}
