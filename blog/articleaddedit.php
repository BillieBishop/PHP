<?php

require_once 'db.php';

$target_dir = "uploads/";
$max_file_size = 5 * 1024 * 1024;

//Only authenticated users are allowed to post a new article
if (!isset($_SESSION['user'])) {
    echo '<h1>Access forbidden</h1>';
    echo "Only logged in users are allowed to post.";
    echo '<a href="index.php">Click to continue</a>';
    exit();
}

function getArticleAddEditForm($title = '', $body = '') {
    $authorID=$_SESSION['user']['name'];
    $pubDate = date("Y-m-d");
    $f = <<< ENDTAG
<h3>Post your article</h3>
<form method="POST" enctype="multipart/form-data">
    Author:<input type="text" name="author" value="$authorID"><br><br>
    Date:<input type="text" name="pubDate" value="$pubDate"><br><br>        
    Picture:<input type="file" name="picFile"><br><br>            
    Title:<input type="text" name="title" value = "$title"><br><br>
    Article:<textarea rows="4" cols="50" name="body" value = "$body"></textarea><br><br>
    <input type="submit" value="Submit">
</form>
ENDTAG;
    return $f;
}

if (!isset($_POST['body'])) {
    echo getArticleAddEditForm();
} else {
    //Receiving a submission   
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

    //Require a picture uploaded
    if (!isset($_FILES['picFile'])) {
        array_push($errorList, "You must upload a picture.");
    } else {
        $fileUpload = $_FILES['picFile'];

        $check = getimagesize($fileUpload["tmp_name"]);
        if (!$check) {
            array_push($errorList, "File upload was not an image file.");
        } elseif (!in_array($check['mime'], array('image/png', 'image/gif', 'image/bmp', 'image/jpeg'))) {
            array_push($errorList, "Error: Only accepting valid png,gif,bmp,jpg files.");
        } elseif ($fileUpload['size'] > $max_file_size) {
            array_push($errorList, "Error: File to big, maximum accepted is $max_file_size bytes");
        }
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
        echo getArticleAddEditForm($title, $body);
    } else {
        //State 2: submission successful
        //Generate own file name, preventing sql injection
        $file_name = preg_replace("/[^A-Za-z0-9\-]/", '_', $fileUpload['name']);
        $file_extension = explode('/', $check['mime'])[1];
        $target_file = $target_dir . date("Ymd-His-") . $file_name . '.' . $file_extension;

        if (move_uploaded_file($fileUpload["tmp_name"], $target_file)) {
            echo "The file " . basename($fileUpload["name"]) . " has been uploaded.";
        } else {
            die("Fatal error: There was a server-side error handling the upload of your file.");
        }
        $sql = sprintf("INSERT INTO articles VALUES (NULL, '%s','%s', '%s', '%s', '%s')", 
                mysqli_escape_string($conn, $_SESSION['user']['ID']), 
                mysqli_escape_string($conn, date("Y-m-d")), 
                mysqli_escape_string($conn, $title), 
                mysqli_escape_string($conn, $body), 
                mysqli_escape_string($conn, $target_file));
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [$sql] : " . mysqli_error($conn));
        } else {
            echo "Submission successful.";
            echo "<a href=\"index.php\">Go to home page</a>";
        }
    }
}
