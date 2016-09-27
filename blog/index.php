<?php

//print_r($_SESSION);
require_once 'db.php';
if (isset($_SESSION['user'])) {
    echo "Welcome " . $_SESSION['user']['name'] . "!<br>";
    echo 'You may <a href = "logout.php">Logout</a>' . ', <a href="articleaddedit.php?link=1">Post an article</a>' . ' or '. '<a href = "articleaddedit.php?link=2" value = "edit">Edit an article</a>';
} else {
    echo "You are not logged in.<br>";
    echo '<a href = "login.php">Login</a> or <a href = "register.php">Register</a>';
}

$sql = "SELECT articles.ID as articleID, name, pubDate, title, body FROM articles, users WHERE articles.authorID = users.ID ORDER BY articles.ID desc LIMIT 5";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo 'Error executing query [sql] :'.  mysqli_error($conn);
    exit;
}

$dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo"<ul>";
foreach ($dataRows as $row){
    $ID=$row['articleID'];
    $author = htmlspecialchars($row['name']);
    $pubDate = $row['pubDate'];
    $title = htmlspecialchars($row['title']);
    $body=  htmlspecialchars($row['body']);
    echo "<li>$title: $author, $pubDate <a href = \"articleview.php?id=$ID\">View Article</a></li>";
}
//TODO:to edit, maybe I should put a link on the title that would link
// to the article in addedit already in the form. I would prefer an edit page
//  than addedit on the same page. Easier.
