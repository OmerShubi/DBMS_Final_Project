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
        $sql = "create table PremierLeague(
                                      id int primary key,
                                      Home varchar(50),
                                      Away varchar(50),
                                      notes varchar(5000),
                                      home_goals int,
                                      away_goals int,
                                      result varchar(1),
                                      season varchar(10)
                 );";

        $sql = "CREATE TABLE Trek(
        trekName      VARCHAR(20) PRIMARY KEY,
  length        FLOAT,
  LAT			FLOAT,
  LONG			FLOAT
);

CREATE TABLE TrekInCountry(
        countryName   VARCHAR(20),
  trekName      VARCHAR(20),
  PRIMARY KEY (countryName, trekName),
  FOREIGN KEY (trekName) REFERENCES Trek(trekName) ON DELETE CASCADE
);

CREATE TABLE Hiker(
        ID             INTEGER PRIMARY KEY,
  fullName       VARCHAR(20) NOT NULL ,
  originCountry  VARCHAR(20) NOT NULL ,
  Smoker         VARCHAR(3),
  Fitness        INTEGER,
  CHECK (Smoker='Yes' OR Smoker='No'),
  CHECK (Fitness>=0 AND Fitness<=100)
)

CREATE TABLE HikerInTrek(
        hikerID         INTEGER,
  trekName        VARCHAR(20),
  startDate       DATE,
  PRIMARY KEY (hikerID, trekName),
  FOREIGN KEY (hikerID) REFERENCES Hiker(ID) ON DELETE CASCADE,
  FOREIGN KEY (trekName) REFERENCES Trek ON DELETE CASCADE
);";"
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
