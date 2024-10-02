<?php

if (!empty($_POST['email']) && !empty($_POST['apiKey'])) {

    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];

    include 'conn.php';

    if ($conn) {
        $sql = "SELECT * FROM user_data WHERE email = '".$email."' AND apiKey = '".$apiKey."'";
        $res = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($res === false) {
            // Output the SQL error
            echo "SQL error: " . mysqli_error($conn);
        } else {
            // Proceed if query is successful
            if (mysqli_num_rows($res) != 0) {
                $row = mysqli_fetch_assoc($res);

                $sqlUpdate = "UPDATE user_data SET apiKey = '' WHERE email = '".$email."'";
                if (mysqli_query($conn, $sqlUpdate)) {
                    echo "1";
                } else {
                    echo "0" . mysqli_error($conn);
                }
            } else {
                echo "No matching user found.";
            }
        }
    } else {
        echo "Database connection failed.";
    }
}
?>
