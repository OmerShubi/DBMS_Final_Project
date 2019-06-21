<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Trek Pro Analytics | Table</title>
</head>
<body>
    <?php
        include 'db_connection.php';
        // Open Connection
        $conn = OpenCon();


        // Creates the table. If already exists the query sends back an error, but has no effect
        // So continues program as expected.
        $sql = file_get_contents('Create_Tables.sql');
        sqlsrv_query($conn, $sql);

        $sql_most_hiked_trek = "SELECT top(1) trekName
                 FROM HikerInTrek
                 GROUP BY trekName
                 ORDER BY COUNT(hikerID) DESC, trekName ASC;";

        $result_most_hiked_trek = sqlsrv_query($conn, $sql_most_hiked_trek);

        $sql_most_trekked_hiker = " SELECT top(1) Hiker.fullName
                                    FROM HikerInTrek, Hiker
                                    WHERE HikerInTrek.hikerID = Hiker.ID
                                    GROUP BY hikerID, Hiker.fullName
                                    ORDER BY COUNT(trekName) DESC, Hiker.fullName ASC;";

        $result_most_trekked_hiker = sqlsrv_query($conn, $sql_most_trekked_hiker);

        $sql_last_Nepal_hiker = "SELECT   top(1) Hiker.fullName
                                FROM HikerInTrek HIT, TrekInCountry TIC,Hiker
                                WHERE not exists(
                                        (SELECT TrekInCountry.trekName
                                         FROM TrekInCountry
                                         WHERE countryName = 'Nepal')
                            
                                        EXCEPT
                            
                                        (SELECT HIT2.trekName
                                            FROM  HikerInTrek HIT2 ,TrekInCountry TIC2
                                            Where HIT2.hikerID = HIT.hikerID AND TIC2.countryName='Nepal' AND HIT2.trekName=TIC2.trekName)
                            
                                    ) AND HIT.trekName=TIC.trekName AND TIC.countryName='Nepal' AND HIT.hikerID=Hiker.ID
                                ORDER BY HIT.startDate DESC ;";

        $result_last_Nepal_hiker = sqlsrv_query($conn, $sql_last_Nepal_hiker);


        // Displays the Table
        echo '<table>';

        echo "<thead><tr><th>Most Hiked Trek</th><th>Most Experienced Hiker</th><th>Special Hiker</th></tr></thead>";

        $row1 = sqlsrv_fetch_array($result_most_hiked_trek, SQLSRV_FETCH_NUMERIC);
        $mostHikedTrek = $row1[0];

        $row2 = sqlsrv_fetch_array($result_most_hiked_trek, SQLSRV_FETCH_NUMERIC);
        $MostTrekkedHiker = $row2[0];

        $row3 =sqlsrv_fetch_array($result_last_Nepal_hiker, SQLSRV_FETCH_NUMERIC);
        $LastNepalHiker = $row3[0];

        echo "<tr><td>".$mostHikedTrek."</td><td>".$MostTrekkedHiker."</td><td>".$LastNepalHiker."</td></tr>";
        echo "</table>";

        /* Close the connection. */
        sqlsrv_close( $conn);
    ?>
</body>
</html>
