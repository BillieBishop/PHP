<?php

session_start();//activating the mecanism of a new session

$db_user = "quiz2gallery";
$db_name = "quiz2gallery";
$db_password = "TYbGC4FpzwcqYEMF";

$conn = mysqli_connect('localhost', $db_user, $db_password, $db_name);
if (!$conn) {
    die("Error connecting to database: " . mysqli_error($conn));
}
