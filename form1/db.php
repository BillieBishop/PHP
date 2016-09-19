<?php

$db_user = "ipd8people";
$db_name = "ipd8people";
$db_password = "zy37UAQQQXA5mQtx";

$conn = mysqli_connect('localhost', $db_user, $db_password, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}

