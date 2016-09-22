<?php

$db_user = "todoitem";
$db_name = "todoitem";
$db_password = "rPV4e3Lw5NPxbxMm";

$conn = mysqli_connect('localhost', $db_user, $db_password, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}

