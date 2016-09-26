<?php

require_once 'db.php';

if(!isset($GET['id'])){
    die("No article to view.");
}

$sql = sprintf("SELECT * FROM articles, users WHERE authorID=users.ID AND articles.ID = '%s'", mysqli_escape_string($conn, $_GET['id']));
$result = mysqli_query($conn, $sql);

if(!$result){
    die("Error executing query [$sql] : ".mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if(!$row){
    die("No article was found.");
}

$title = htmlspecialchars($row['title']);
$body =htmlspecialchars($row['body']);
$author = $row['name'];
$pubDate = $row['pubDate'];
$imagePath = $row['imagePath'];

echo "<h3>$title</h3>";
echo "<p><b>Posted by</b>$author at $pubDate</p><br><br>";
echo sprintf('<img src = "%s">', $imagePath);
echo "<p>$body</p>";


