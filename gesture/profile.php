<?php

if(!empty($_POST['email']) && !empty($_POST['apiKey'])){

    $email = $_POST['email'];
    $apiKey = $_POST['apiKey'];
    $result = array();

    
   $conn = include 'conn.php';


    if($conn){
        $sql = "SELECT * FROM userdata WHERE email = '".$email."' AND apiKey = '".$apiKey."'";
        $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_assoc($res);
                $result = array(
                "success"=>"1",
                "message"=>"Data fetched",
                "name"=>$row['username'],
                "email"=>$row['email'],
                "apiKey"=>$row['apiKey'],);

            }else{
                $result = array(
                    "success"=>"0",
                    "message"=>"Unauthorized Access",
                );
            }
        }
            else{
                $result = array(
                    "success"=>"0",
                    "message"=>"Database conn failed",
                );
        }

    }
    
   
else{
    $result = array(
        "success"=>"0",
        "message"=>"All fields required",
    );
}




echo json_encode($result);


?>