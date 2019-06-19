<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Trek Pro Analytics | Table</title>
</head>
<body>
    <?php
        include 'db_connection.php';
        include 'Create_Tables.sql';
        // Open Connection
        $conn = OpenCon();


        // Creates the table. If already exists the query sends back an error, but has no effect
        // So continues program as expected.
        $sql = file_get_contents('Create_Tables.sql');
        sqlsrv_query($conn, $sql);

        // Displays the Table
        $sql = "SELECT * FROM PremierLeague;" ;

        $result = sqlsrv_query($conn, $sql);

        echo '<table>';

        echo "<thead><tr><th>Most Hiked Trek</th><th>Most Experienced Hiker</th><th>Special Hiker</th></tr></thead>";

        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            $mostHikedTrek = $row['mostHikedTrek'];
            $MostExpHiker = $row['MostExpHiker'];
            $SpecialHiker = $row['SpecialHiker'];

            echo "<tr><td>".$mostHikedTrek."</td><td>".$MostExpHiker."</td><td>".$SpecialHiker."</td></tr>";
        }
        echo "</table>";

        /* Close the connection. */
        sqlsrv_close( $conn);
    ?>
</body>
</html>
