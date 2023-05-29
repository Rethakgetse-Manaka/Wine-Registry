<?php 
    $servername = "wheatley.cs.up.ac.za";
    $username = "u22492616";
    $password = "SP2ZUCDHYQNAQQKYBZ4XIP7CFRWJEO33";
    
    // Create connection
    $conn = new mysqli($servername, $username,
    $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn
        ->connect_error);
    }
?>