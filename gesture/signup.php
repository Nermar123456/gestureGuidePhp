<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get POST data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];  // Match the parameter name
    $lastName = $_POST['lastName'];    // Match the parameter name
    $middleName = $_POST['middleName'];     // Match the parameter name
    $middleInitial = $_POST['middleInitial']; // Match the parameter name
    $suffix = $_POST['suffix'];            // Match the parameter name
    $birthday = $_POST['birthday'];
    $number = $_POST['number'];
    $address = $_POST['street'];        // Match the parameter name
    $lrn = $_POST['lrn'];
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'conn.php';

    $sql = "INSERT INTO user_data (lrn, email, password, username, firstName, lastName, middleName, middleInitial, suffix, birthday, number, address) VALUES ('$lrn','$email', '$password', '$username', '$firstName', '$lastName', '$middleName', '$middleInitial', '$suffix', '$birthday', '$number', '$address')";

    if(mysqli_query($conn, $sql)){
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);
    } else {
        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);
    }
}
?>