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
function getPictureAddForm($description = '') {            
        $f = <<< ENDTAG
<h3>Post your picture</h3>
<form method="POST" enctype="multipart/form-data">    
File:<input type="file" name="picFile"><br><br>            
Description:<input type="text" name="description" value = "$description"><br><br>
<input type="submit" value="Add">
</form>
ENDTAG;
        return $f;
    }

    if (!isset($_POST['description'])) {
        echo getPictureAddForm();
    } else {
        //Receiving a submission   
        $description = $_POST['description'];
      
        $errorList = array();

        //Require subject at least 4 characters long
        if (strlen($description) < 4) {
            array_push($errorList, "Description must be at least 4 characters long.");
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
                array_push($errorList, "Error: File too big, maximum accepted is $max_file_size bytes.");
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
            //Redisplay form if submission has failed
            echo getPictureAddForm();
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
            $sql = sprintf("INSERT INTO pictures VALUES (NULL, '%s', '%s', '%s')",
                    mysqli_escape_string($conn, $_SESSION['user']['ID']),
                    mysqli_escape_string($conn, $target_file),
                    mysqli_escape_string($conn, $description));
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error executing query [$sql] : " . mysqli_error($conn));
            } else {
                echo "Submission successful.";
                echo "<a href=\"index.php\">Go to home page</a>";
            }
        }
    }

