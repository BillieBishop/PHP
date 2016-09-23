<?php

require_once 'db.php';

$authorID = $_SESSION['user']['name'];
echo date("d-m-Y");
//date_default_timezone_set('America/New_York');
//$pubDate = $_POST['pubdate'];
$pubDate = date("Y-m-d");

//$pubDate = new DateTime();
//$pubDate->setTimestamp($timestamp);
//var_dump($pubDate->format('d-m-Y H:i:s e'));

function getArticleAddEditForm($authorID, $pubdate, $title = '', $body = '') {
    $f = <<< ENDTAG
<h3>Post your article</h3>
<form method="POST" enctype="multipart/form-data">
    Author:<input type="text" name="author" value="$authorID"><br><br>
    Date:<input type="date" name="pubdate" value="date"><br><br>
    Title:<input type="text" name="title" value = "$title"><br><br>
    Article:<textarea rows="4" cols="50" name="body" value = "$body"></textarea><br><br>
    Select image to upload:<input type="file" name="fileToUpload">    
    <input type="submit" value="Submit">
</form>
ENDTAG;
    return $f;
}

if (!isset($_SESSION['user'])) {
    echo '<h1>Access forbidden</h1>';
    echo "Only logged in users are allowed to post.";
    echo '<a href="index.php">Click to contunue</a>';
    exit();
} else {
    if (!isset($_POST['title'])) {
        echo getArticleAddEditForm($authorID, $pubDate);
    } else {
        //Receiving a submission
        //$pubDate = $_POST['pubdate'];
        //$pubDate = new DateTime();
        //$pubDate->setTimestamp($timestamp);
        //var_dump($pubDate->format('d-m-Y H:i:s e'));

        $title = $_POST['title'];
        $body = $_POST['body'];

        $errorList = array();

        //Require subject at least 4 characters long
        if (strlen($title) < 4) {
            array_push($errorList, "Subject must be at least 4 characters long");
        }

        //Require body at least 50 characters long
        if (strlen($body) < 50) {
            array_push($errorList, "Article must be at least 50 characters long");
        }

        //check if array of errors is empty
        if ($errorList) {
            //State 3: submission failed - problem found
            echo "<h5>Problems found in your submission</h5>\n";
            echo "<ul>\n";
            foreach ($errorList as $error) {
                echo "<li>" . htmlspecialchars($error) . "</li>";
            }
            echo "</ul>\n";
            //Make sure you re-display subject and body if submission has failed
            echo getArticleAddEditForm($authorID, $pubdate, $title, $body);
        } else {
            //State 2: submission successful
            $sql = sprintf("INSERT INTO articles VALUES (NULL, '%s','%s', '%s', '%s')", mysqli_escape_string($conn, $authorID), mysqli_escape_string($conn, $pubDate), mysqli_escape_string($conn, $title), mysqli_escape_string($conn, $body));
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error executing query [$sql] : " . mysqli_error($conn));
            } else {
                echo "Submission successful.";
                echo getArticleAddEditForm($authorID, $pubDate);
            }
        }
    }
}



//TODO: Add 3 state form with Subject and body (text area)
//Require subject at least 4 characters long
//Require body at least 50 characters long
//Make sure you re-display subject and body if submission has failed.
//On successful submission, add article to database.

//index.php

//TODO:Add code to fetch the latest 5 articles from database
//and display their title, author, and date of creation. JOIN

//articleview.php?id=7

//TODO:Add code to fetch

//$authorID=$_SESSION['user']['ID'];
