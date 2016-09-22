<?php

//heredoc
function getForm($ee = '', $dd = '') {
    $f = <<<ENDTAG
      
    <form action="index.php" method="POST">
            Description:<input type="textarea" name="description"><br>
            Due date:<input type="textarea" name="dueDate"><br>
            <input type="submit" value="Add">
        </form>
ENDTAG;
    return $f;
}

require_once 'db.php';

if (!isset($_POST['description']) || !isset($_POST['dueDate'])) {
    echo "Error: description and due date must be provided.";
} else {
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];
    //$isDone = $_POST['isDone'];
    $errorList = array();
    if (empty([$description])) {
        array_push($errorList, "Error: description must not be empty.");
    }

    if (empty([$dueDate])) {
        array_push($errorList, "Error: due date must not be empty.");
    }

    if (!strlen($description) > 2) {
        array_push($errorList, "Error: description must say something.");
    }
    //^\d{4}-\d{2}-\d{2}$
    if (!preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $dueDate)) {
        array_push($errorList, "Error: date must be in format YYYY/MM/DD.");
    }

    if ($errorList) {
        //State 3: Submission failed - problem found
        echo "<h5>Problems found in your submission</h5>\n";
        echo "<ul>\n";
        foreach ($errorList as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "<ul>\n";
    } else {
        echo "$description is due on $dueDate.";
        require_once 'db.php';
        //PREVENTING SQL INJECTION
        $sql = sprintf("INSERT INTO task VALUES(        
        mysqli_escape_string($conn, $description),
        mysqli_escape_string($conn, $dueDate))");
        //mysqli_escape_string($conn, $isDone)
        //(NULL, '%s', '%s', '%d')"
        //('$description', '$dueDate', 'isDone')"),
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [$sql] : " . mysqli_error($conn));
        } else {
            echo "Submission successful.";
        }
    }
}
