<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'inventory_db';

$conn = new mysqli($host,$user,$password,$dbname);

if ($conn->connect_error) {
    die("database connection is failed " . $conn->connect_error);
}

?>