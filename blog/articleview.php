<?php

require_once 'db.php';

//Article view
if (!isset($_GET['id'])) {
    die("No article to view.");
}

$sql = sprintf("SELECT * FROM articles, users WHERE authorID=users.ID AND articles.ID = '%s'", mysqli_escape_string($conn, $_GET['id']));
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error executing query [$sql] : " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("No article was found.");
}

$title = htmlspecialchars($row['title']);
$body = htmlspecialchars($row['body']);
$author = $row['name'];
$pubDate = $row['pubDate'];
$imagePath = $row['imagePath'];

echo "<h2>$title</h2>";
echo "<p><b>Posted by </b>$author at $pubDate</p><br><br>";
//echo sprintf('<img src = "%s">', $imagePath);
echo sprintf('<img src = "%s">', $imagePath);
echo "<p>$body</p>";

//Comment view
$query = sprintf("SELECT users.name as name, comments.body as body, comments.pubTimestamp FROM comments, articles, users WHERE articles.ID=comments.articleID AND users.ID=comments.authorID AND articles.ID = '%s'", mysqli_escape_string($conn, $_GET['id']));
$commentresult = mysqli_query($conn, $query);

if (!$commentresult) {
    die("Error executing query [$query] : " . mysqli_error($conn));
}

$commentrow = mysqli_fetch_all($commentresult, MYSQLI_ASSOC);

if (!$commentrow) {
    echo("No comment was found.");
} else {
    foreach ($commentrow as $crow) {
        $authorID = $crow['name'];
        $body = htmlspecialchars($crow['body']);
        $pubTimestamp = $crow['pubTimestamp'];
        echo "<b>$authorID</b>, left a comment on $pubTimestamp:<br>$body<br><br>";
    }
}

//Post a comment
function getAddCommentForm($body = '', $authorID = '') {
    // $authorID=$_SESSION['user']['name'];
    $f = <<< ENDTAG
<h3>Post your comment</h3>
<form method="POST">
    Author:<input type="text" name="author" value="$authorID"><br><br>       
    Comment:<textarea rows="4" cols="50" name="body" value = "$body"></textarea><br><br>
    <input type="submit" value="Submit">
</form>
ENDTAG;
    return $f;
}

if (!isset($_POST['body'])) {
    echo getAddCommentForm();
} else {
    //Receiving a submission   
    $body = $_POST['body'];

    $errorList = array();

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
        echo getAddCommentForm($body);
    } else {
        //State 2: submission successful        
        $sql = sprintf("INSERT INTO comments VALUES (NULL, '%s','%s', '%s', '%s')", mysqli_escape_string($conn, $_GET['id']), //articleID
                mysqli_escape_string($conn, $_SESSION['user']['ID']), //authorID
                mysqli_escape_string($conn, $body), //body                
                mysqli_escape_string($conn, date("Y-m-d G:i:s")));   //pubTimestamp

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [$sql] : " . mysqli_error($conn));
        } else {
            echo "Submission successful.";
            echo "<a href=\"index.php\">Go to home page</a>";
        }
    }
}

