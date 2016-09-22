<?php
//heredoc
function getForm($nn = '', $aa = '', $gg = '', $hh = '') {
    $f = <<< ENDTAG
<h3>Add or Edit Student</h3>
<form method="POST">      
    First and last name:<input type="text" name="name" value="$nn"><br><br>
    Age:<input type="number" name="age" value="$aa"><br><br>
    GPA:<input type="text" name="gpa" value="$gg"><br><br>
    <input type="checkbox" name="hasgraduated" value="$hh">Has graduated?<br><br>
    <input type="submit" value="Save">
</form>
ENDTAG;
    return $f;
}

require_once 'db.php';
/*
echo "<pre>\n";
print_r($_POST);
echo "</pre>\n\n";
 */

if (!isset($_POST['name'])) {
    echo getForm();
} else {
    //Receiving a submission
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gpa = $_POST['gpa'];
    $hasgraduated = $_POST['hasgraduated'];
    $errorList = array();    
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long.");
    }
    if (($age < 1) || ($age > 150)) {
        array_push($errorList, "Age must be between 1 and 150.");
    }
    if (($gpa < 0) || ($gpa > 4.3)) {
        array_push($errorList, "Gpa must be between 0 and 4.3.");
    }
    
    //http://stackoverflow.com/questions/15520512/form-validation-checkbox-input-through-php
    if(isset($_POST['hasgraduated'])){
        $hasgraduated = 'yes';
    }  else {
        $hasgraduated = 'no';
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
        echo getForm($name, $age, $gpa, $hasgraduated);
    } else {
        //State 2: submission successful
        require_once 'db.php';
        //Preventing SQL injection
        $sql = sprintf("INSERT INTO student VALUES (NULL, '%s', '%s', '%s', '%s')",         
                mysqli_escape_string($conn, $name),
                mysqli_escape_string($conn, $age),
                mysqli_escape_string($conn, $gpa),
                mysqli_escape_string($conn, $hasgraduated));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [$sql] : " . mysqli_error($conn));
        } else {
            echo "Submission successful.";
            echo getForm();
        }
    }
}
