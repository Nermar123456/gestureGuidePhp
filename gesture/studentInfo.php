<?php
include 'conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input data
    $username = $_POST['username'];
    
    $user_id = intval($_POST['user_id']);  // Ensure user_id is an integer
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $middleInitial = $_POST['middleInitial'];
    $suffix = $_POST['suffix'];
    $birthday = $_POST['birthday'];  // Expecting 'YYYY-MM-DD' format
    $number = intval($_POST['number']);  // Ensure number is an integer
    $address = $_POST['address'];
    $apiKey = mysqli_real_escape_string($conn, $_POST['apiKey']);  // Sanitize API key

    // Initialize response array
    $response = array();

    // Log input data for debugging
    error_log("User ID: $user_id");

    // Check API key for security
    $query = "SELECT * FROM user_data WHERE user_id = ? AND apiKey = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        $response['success'] = "0";
        $response['message'] = "Database prepare failed";
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("is", $user_id, $apiKey);
    $stmt->execute();
    $result = $stmt->get_result();

    error_log("Number of rows returned: " . $result->num_rows);

    if ($result->num_rows > 0) {
        // Prepare the update query using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE user_data SET 
            username=?, firstName=?, lastName=?, middleName=?, middleInitial=?, suffix=?, birthday=?, number=?, address=? 
            WHERE user_id=? AND apiKey=?");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            $response['success'] = "0";
            $response['message'] = "Database prepare failed";
            echo json_encode($response);
            exit;
        }

        $stmt->bind_param("sssssssisis", $username, $firstName, $lastName, $middleName, $middleInitial, $suffix, $birthday, $number, $address, $user_id, $apiKey);

        // Execute the query and handle errors
        if ($stmt->execute()) {
            $response['success'] = "1";
            $response['message'] = "Profile updated successfully";

            // Include the updated user data in the response
            $response['user_id'] = $user_id;
            $response['username'] = $username;
            $response['firstName'] = $firstName;
            $response['lastName'] = $lastName;
            $response['middleName'] = $middleName;
            $response['middleInitial'] = $middleInitial;
            $response['suffix'] = $suffix;
            $response['birthday'] = $birthday;
            $response['number'] = $number;
            $response['address'] = $address;
        } else {
            $response['success'] = "0";
            $response['message'] = "Error updating profile: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $response['success'] = "0";
        $response['message'] = "Invalid API key";
    }

    // Send the response back
    echo json_encode($response);
}

// Close database connection
$conn->close();
?>
