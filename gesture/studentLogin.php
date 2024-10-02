<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email and password are set in the POST request
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = ($_POST['email']);  // Convert email to lowercase
        $password = $_POST['password'];

        require_once 'conn.php';

        // SQL query to get user data by email
        $sql = "SELECT * FROM user_data WHERE email = '$email'";
        $response = mysqli_query($conn, $sql);

        // Prepare the result array
        $result = array();
        $result['login'] = array();

        if (!$response) {
            // Check for SQL errors
            $result['success'] = '0';
            $result['message'] = 'SQL error: ' . mysqli_error($conn);
            echo json_encode($result);
        } else {
            // If a matching user is found
            if (mysqli_num_rows($response) === 1) {
                $row = mysqli_fetch_assoc($response);

                // Verify the password
                if (password_verify($password, $row['password'])) {
                    // Generate a new API key
                    try {
                        $apiKey = bin2hex(random_bytes(23));
                    } catch (Exception $e) {
                        $apiKey = bin2hex(uniqid($email, true));
                    }

                    // Update the user with the new API key
                    $sqlUpdate = "UPDATE user_data SET apiKey = '$apiKey' WHERE email = '$email'";
                    if (mysqli_query($conn, $sqlUpdate)) {
                        // Prepare the response with user data
                        $index = array(
                            'username' => $row['username'],
                            'user_id' => $row['user_id'],
                            'email' => $row['email'],
                            'name' => $row['name'],
                            'number' => $row['number'],
                            'birthday' => $row['birthday'],
                            'street' => $row['address'],
                            'lrn' => $row['lrn'],
                            'firstName' => $row['firstName'],
                            'lastName' => $row['lastName'],
                            'middleName' => $row['middleName'],
                            'middleInitial' => $row['middleInitial'],
                            'suffix' => $row['suffix'],
                            'apiKey' => $apiKey
                        );

                        // Add the user data to the login array
                        array_push($result['login'], $index);

                        // Set success response
                        $result['success'] = '1';
                        $result['message'] = 'Login successful';

                        echo json_encode($result);
                    } else {
                        // If the API key update failed
                        $result['success'] = '0';
                        $result['message'] = 'Failed to update API key';
                        echo json_encode($result);
                    }
                } else {
                    // If the password is incorrect
                    $result['success'] = '0';
                    $result['message'] = 'Incorrect password';
                    echo json_encode($result);
                }
            } else {
                // If no user was found with that email
                $result['success'] = '0';
                $result['message'] = 'User not found';
                echo json_encode($result);
            }
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If email or password is missing
        $result['success'] = '0';
        $result['message'] = 'Missing email or password';
        echo json_encode($result);
    }
} else {
    // If the request method is not POST
    $result['success'] = '0';
    $result['message'] = 'Invalid request method';
    echo json_encode($result);
}
?>
