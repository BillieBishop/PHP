<?php

require_once 'db.php';

//heredoc
function getRegisterForm($email = '') {
    $f = <<< ENDTAG
<h3>Register user</h3>
<form method="POST">    
    Email:<input type="text" name="email" value="$email"><br><br>
    Password:<input type="password" name="password"><br><br>
    Password(retype):<input type="password" name="password2"><br><br>        
    <input type="submit" value="Register">
</form>
ENDTAG;
    return $f;
}

//Tri-state form
//1-Show
//2-Submission successful
//3-Submission failed (show error list and form again)

if (!isset($_POST['email'])) {
    //State 1: first show
    echo getRegisterForm();
} else {
    //Receiving a submission
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    //submission received - verify
    $errorList = array();

    //email check: looks like a valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email.");
    } else {
        //email check: existing email from database    
        $query = sprintf("SELECT ID FROM users WHERE email = '%s'", mysqli_escape_string($conn, $email));
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Error executing query: " . mysqli_error($result));
        }
        if (mysqli_num_rows($result) != 0) {
            array_push($errorList, "Email already registered.");
        }
    }
    //password check: 8 caracters minimum
    if (strlen($password) < 8) {
        array_push($errorList, "Password must be at least 8 characters long.");
    } else {
        //password check: containing at least 1 lowercase, 1 uppercase, 1 number and 1 special character       
        $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!#$%^&*()+=<>?]).+$/';
        if (!preg_match($regexPassword, $password)) {
            array_push($errorList, "Password must contains at least 1 lowercase, 1 uppercase, 1 number and 1 specialcharacter.");
        }else if (!$password2 === $password) {
        //password check: password2 the same as first password        
            array_push($errorList, "Both passwords must be the same.");
        }
    }
    
    //we check if array of errors is empty (so we validated all) empty array=false
    if ($errorList) {
        //State 3: submission failed - problem found
        echo "<h5>Problems found in your submission</h5>\n";
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>\n";
        echo getRegisterForm($name, $email);
    } else {
        //State 2: submission successful
        $sql = sprintf("INSERT INTO users VALUES (NULL, '%s', '%s')", mysqli_escape_string($conn, $email), mysqli_escape_string($conn, $password));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [$sql] : " . mysqli_error($conn));
        } else {
            echo "Submission successful.";
            echo '<a href="login.php">Click to login</a>';
        }
    }
}
    


