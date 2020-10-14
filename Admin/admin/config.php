<?php
    

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $dbname = "admin_cart";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    echo 'success';
?>