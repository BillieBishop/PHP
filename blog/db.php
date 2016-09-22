<?php
$db_user = "ipd8blog";
$db_name = "ipd8blog";
$db_password = "FSBfG6jQX9cAbYce";

$conn = mysqli_connect('localhost', $db_user, $db_password, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
