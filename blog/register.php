<?php
require_once 'db.php';
//heredoc
function getRegisterForm($nn = '', $mm = '', $p1 = '', $p2 = '') {
    $f = <<< ENDTAG
<h3>Register user</h3>
<form method="POST">
    Name:<input type="text" name="name" value="$nn"><br><br>
    Email:<input type="text" name="email" value="$mm"><br><br>
    Password:<input type="password" name="password" value="$p1"><br><br>
    Password(retype):<input type="password" name="password2" value="$p2"><br><br>        
    <input type="submit" value="Register">
</form>
ENDTAG;
    return $f;
}
//Tri-state form
//1-Show
//2-Submission successful
//3-Submission failed (show error list and form again)

if (!isset($_POST['name'])) {
    echo getRegisterForm();
} else {
    //Receiving a submission
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $errorList = array();

    //name check: 4 characters minimum
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long.");
    }

    //email check: looks like a valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email.");
    } else {
        //email check: existing email from database    
        $query = "SELECT ID FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Error executing query: " . mysqli_error($result));
        } else {
            $numOfRows = mysqli_num_rows($result);
            if ($numOfRows == 1) {
                array_push($errorList, "You are already registered.");
            }
        }
        //password check: 8 caracters minimum
        if (strlen($name) < 8) {
            array_push($errorList, "Password must be at least 8 characters long.");
        }else{

        //password check: containing at least 1 lowercase, 1 uppercase, 1 number and 1 special character       
        $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!#$%^&*()+=<>?]).+$/';
        if (!preg_match($regexPassword, $password)) {
            array_push($errorList, "Password must contains at least 1 lowercase, 1 uppercase, 1 number and 1 specialcharacter.");
        }

        //password check: password2 the same as first password
        else if (!$password2 === $password) {
            array_push($errorList, "Both passwords must be the same.");
        }
        }

        //email check: existing email from database    
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $numOfRows = mysqli_num_rows($result);
        if ($numOfRows == 1) {
            echo"You are already registered.";
            echo getRegisterForm();
        } else {
            //we check if array of errors is empty (so we validated all) empty array=false
            if ($errorList) {
                //State 3: submission failed - problem found
                echo "<h5>Problems found in your submission</h5>\n";
                echo "<ul>\n";
                foreach ($errorList as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                echo "</ul>\n";
                echo getRegisterForm($name, $email, $password, $password2);
            } else {
                //State 2: submission successful
                $sql = sprintf("INSERT INTO users VALUES (NULL, '%s', '%s', '%s')", mysqli_escape_string($conn, $name), mysqli_escape_string($conn, $email), mysqli_escape_string($conn, $password));
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Error executing query [$sql] : " . mysqli_error($conn));
                } else {
                    echo "Submission successful.";
                    echo getRegisterForm();
                }
            }
        }
    }
}