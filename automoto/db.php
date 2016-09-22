<?php

$db_user = "ipd8automoto";
$db_name = "ipd8automoto";
$db_password = "wZWLXvUSrzNdNS49";

$conn = mysqli_connect('localhost', $db_user, $db_password, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}