<?php

require_once 'db.php';

//heredoc
function getLoginForm() {
    $f = <<< ENDTAG
<h3>Login user</h3>
<form method="POST">    
    Email:<input type="text" name="email"><br><br>
    Password:<input type="password" name="password"><br><br>       
    <input type="submit" value="Login">
</form>
ENDTAG;
    return $f;
}

//Tri-state form
//1-Show
//2-Submission successful
//3-Submission failed (show error list and form again)

if (!isset($_POST['email'])) {
    echo getLoginForm();
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = sprintf("SELECT * FROM users WHERE email = '%s'", mysqli_escape_string($conn, $email));
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error executing query [$query]: " . mysqli_error($conn));
    }

    $numOfRows = mysqli_num_rows($result);
    if ($numOfRows == 0) {
        echo "Login failed.";
        echo getLoginForm();
    } else {
        $row = mysqli_fetch_assoc($result);
        //password MUST be compared in PHP because SQL is case-insensitive
        if ($row['password'] == $password) {
            //login successful            
            unset($row['password']);
            $_SESSION['user']=$row;
            echo "Login successful. ".'<a href = "index.php">Click to continue</a>';
        } else {
            echo "Login failed.";
            echo getLoginForm();
        }
    }
}