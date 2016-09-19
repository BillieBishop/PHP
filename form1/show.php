<?php
require_once 'db.php';

$sql = "SELECT * FROM person";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error executing query [$sql] : " . mysqli_error($conn));
}
$numrows = mysqli_num_rows($result);
echo "<p>Number of rows fetched: $numrows</p>\n";

$dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);

//print_r($dataRows);
echo "<table border=1>";
echo "<tr><th>#</th><th>name</th><th>age</th></tr>";

foreach ($dataRows as $row)
{    
    $ID = $row['ID'];
    $name = htmlspecialchars($row['name']); //translate minimum (prefered)
    //$name = htmlentities($row['name']); translate all
    $age = $row['age'];
    echo "<tr><td>$ID</td><td>$name</td><td>$age</td></tr>\n";
}

echo "</table>\n\n";
