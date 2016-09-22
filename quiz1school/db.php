<?php

$db_user = "quiz1school";
$db_name = "quiz1school";
$db_password = "XRAsZbETqyZQLSXw";

$conn = mysqli_connect('localhost', $db_user, $db_password, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
