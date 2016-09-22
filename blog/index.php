<?php

//print_r($_SESSION);
require_once 'db.php';
if (isset($_SESSION['user'])) {
    echo "Welcome " . $_SESSION['user']['name'] . "!<br>";
    echo 'You may <a href = "logout.php">Logout</a>' . ' or <a href="articleaddedit.php">Post an article</a>';
} else {
    echo "You are not logged in.<br>";
    echo '<a href = "login.php">Login</a> or <a href = "register.php">Register</a>';
}
       