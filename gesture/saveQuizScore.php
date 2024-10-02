<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $category_id = $_POST['category_id'];
    $score = $_POST['score'];
    $total_questions = $_POST['total_questions'];
    $date_taken = date('Y-m-d H:i:s');  // Get current timestamp

    // Check if connection is successful
    if ($conn->connect_error) {
        die(json_encode(array("message" => "Database connection failed", "error" => $conn->connect_error)));
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO quiz_score (user_id, category_id, score, total_questions, date_taken) VALUES (?, ?, ?, ?, ?)");

    // Check if the prepare statement was successful
    if ($stmt === false) {
        die(json_encode(array("message" => "Failed to prepare SQL statement", "error" => $conn->error)));
    }

    // Bind parameters (use 'iiiis' for 4 integers and 1 string)
    $stmt->bind_param("iiiis", $user_id, $category_id, $score, $total_questions, $date_taken);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo json_encode(array("message" => "Score saved successfully"));
    } else {
        echo json_encode(array("message" => "Failed to save score", "error" => $stmt->error));
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
