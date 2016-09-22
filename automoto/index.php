<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Car database</title>
    </head>
    <body>
        <a href="caradd.php">Add car</a>
        <table border ="1">
            <?php
            require_once 'db.php';
            $sql =  "SELECT * FROM car";            
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error executing query [$sql] : " . mysqli_error($conn));
            }
            
            $dataRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($dataRows as $row) {
                $ID = $row['ID'];
                $makeModel = htmlspecialchars($row['makeModel']);
                $yop = $row['yop'];
                $plates = htmlspecialchars($row['plates']);
                echo "<tr><td>$ID</td><td>$makeModel</td><td>$yop</td><td>$plates</td></tr>\n";
            }
            ?>
        </table>
    </body>
</html>





