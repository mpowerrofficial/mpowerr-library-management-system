<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "class-system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $username_from_db = "";
    $password_from_db = "";

    $username_from_user = $_POST['username'];
    $password_from_user = $_POST['password'];


    $sql = "SELECT username, password from user_account where auto_id = '3'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        
            $username_from_db = $row['username'];
            $password_from_db = $row['password'];
            
        } 
    } else {
        echo "0 results";
    }


    if($username_from_user == $username_from_db && $password_from_user == $password_from_db){

         // Start the session
        session_start();
        // Set session variables
        $_SESSION["permission"]= "true";

        if($_SESSION["permission"] == "true"){
     
            // Redirect to dashboard.php
            header("Location: dashboard.php");
            exit; // Ensure no further code is executed after the redirect


        }else{
             // Redirect to dashboard.php
             header("Location: index.php");
             exit; // Ensure no further code is executed after the redirect

        }
   
    }else{

        echo "Your password or username is wrong";
    }


    $conn->close();


?>