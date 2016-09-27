<?php

require_once 'db.php';

if (isset($_SESSION['user'])) {
    echo "Welcome " . $_SESSION['user']['email'] . "!<br>";
    echo 'You may <a href = "logout.php">Logout</a>' . ' or '. '<a href = "addpic.php">Upload a picture</a>';
} else {
    echo "You are not logged in.<br>";
    echo '<a href = "login.php">Login</a> or <a href = "register.php">Register</a>';
}
//$sql = "SELECT articles.ID as articleID, name, pubDate, title, body FROM articles, users WHERE articles.authorID = users.ID ORDER BY articles.ID desc LIMIT 5";

$sql = "SELECT * FROM pictures, users WHERE users.ID = pictures.ownerID";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo 'Error executing query [sql] :'.  mysqli_error($conn);
    exit;
}

$dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo"<ul>";
foreach ($dataRows as $row){
    $ID=$row['ID'];
    $ownerID = htmlspecialchars($row['ownerID']);
    //echo sprintf('<img src = "%s">', $imagePath);
    $picturePath = $row['picturePath'];
    $description = htmlspecialchars($row['description']);
    echo '<tr><td>$ID</td><td>$description</td><td><a href="$picturePath"><img src="$picturePath" width="150"/></a></td></tr>\n';  
}
echo"</ul>";