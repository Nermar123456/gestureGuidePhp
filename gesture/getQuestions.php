<?php
include "conn.php";
header('Content-Type: application/json');

// Check if category_id is set
if (!isset($_GET['category_id'])) {
    echo json_encode(["error" => "category_id parameter is missing."]);
    exit;
}

$category_id = $_GET['category_id'];

// SQL query to fetch questions for the given category ID
$sql = "SELECT question, option_a, option_b, correct_answer FROM questions WHERE category_id = '$category_id'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    echo json_encode(["error" => "Error executing the query: " . $conn->error]);
    exit;
}

// Create an array to store the questions
$questions = array();
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

// Return the questions as a JSON response
echo json_encode($questions);
?>
