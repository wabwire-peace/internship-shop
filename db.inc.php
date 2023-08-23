<?php
 // This is the database connection parameters
    $servername = 'localhost'; // This is the database server's hostname
    $username = 'root'; // This is the database username
    $password = ''; // This is the database password incase if i happen to put one
    $database = 'internship'; // This is the name of the database to connect to

   
    $conn = new mysqli($servername, $username, $password, $database); // The code is creating a new MySQLi connection object

   
    if ($conn->connect_error) { // I am checking if the connection is successful
        die("Connection failed: " . $conn->connect_error); // I am checking if the connection failed, output an error message and terminate the script
    }
    ?>