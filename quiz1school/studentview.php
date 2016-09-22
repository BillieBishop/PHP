<?php

require_once 'db.php';
//TODO show a view of student selected
$sql = sprintf("SELECT * FROM student WHERE ID='%d'", mysqli_escape_string($conn, $ID));
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error executing query [ $sql ] : " . mysqli_error($conn));
}

//Fetch data
$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];
$name =  htmlspecialchars($row['name']) ;
$age = $row['age'];
$gpa = $row['gpa'];
$hasgraduated =  $row['hasgraduated'];

//Show data
echo "#: $ID\n\n";
echo "Name: $name\n\n";
echo "Age: $age\n\n";
echo "GPA: $gpa\n\n";

if ($hasgraduated = 'yes'){    
echo "Has graduated.";
}else {
    echo "Has not graduated.";
}

