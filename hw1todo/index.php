<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>To Do</title>
    </head>
    <body>         
        <a style=padding-left:15em; href="taskadd.php">Add item</a><br><br>

        <?php
        //other way to add a link
        //$link = "Add item";
        //echo "<a href=add.php>$link</a><br><br>";

        require_once 'db.php';
        $sql = "SELECT * FROM task";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Error executing query [$sql] :" . mysqli_error($conn));
        }

        echo "<table border =1>";
        echo "<tr><th>#</th><th>description</th><th>due date</th><th>is done</th></tr>";
        $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($dataRows as $row) {
            $ID = $row['ID'];
            $description = htmlspecialchars($row['description']);
            $dueDate = htmlspecialchars($row['dueDate']);
            $isDone = $row['isDone'];
            echo "<tr><td>$ID</td><td>$description</td><td>$dueDate</td><td>$isDone</td></tr>";
        }
        echo "</table>\n\n";
        ?>
    </body>
</html>
