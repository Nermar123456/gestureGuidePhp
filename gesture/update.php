<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $middleInitial = $_POST['middleInitial'];
    $suffix = $_POST['suffix'];
    $birthday = $_POST['birthday'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $apiKey = $_POST['apiKey'];

    $query = "SELECT * FROM users WHERE email = '$email' AND apiKey = '$apiKey'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $updateQuery = "UPDATE users SET 
                        firstName='$firstName', 
                        lastName='$lastName', 
                        middleName='$middleName',
                        middleInitial='$middleInitial',
                        suffix='$suffix',
                        birthday='$birthday', 
                        number='$number', 
                        address='$address' 
                        WHERE id='$userId'";
        
        if (mysqli_query($conn, $updateQuery)) {
            $response['success'] = "1";
            $response['message'] = "Profile updated successfully";
        } else {
            $response['success'] = "0";
            $response['message'] = "Error updating profile";
        }
    } else {
        $response['success'] = "0";
        $response['message'] = "Invalid API key";
    }

    echo json_encode($response);
}

$conn->close();
?>
