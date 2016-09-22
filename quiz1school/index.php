<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz 1 School</title>
    </head>
    <body>
        <a href="studentaddedit.php">Add new student</a>
        <table border="1">
            <tr><th>#</th><th>Name</th></tr>
            <?php
            require_once 'db.php';

            $sql = "SELECT * FROM student";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error executing query [ $sql ] : " . mysqli_error($conn));
            }
            $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($dataRows as $row) {
                $ID = $row['ID'];
                $name = htmlspecialchars($row['name']);                
                echo "<tr><td><a href=\"studentview.php?id=$ID\">$ID</td><td><a href=\"studentview.php?id=$ID\">$name</td></tr>\n";                
            }
            ?>
        </table>
    </body>
</html>
