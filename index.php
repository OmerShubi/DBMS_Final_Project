<html>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics</title>
</head>

<body>
    <img src="Premier_League_Logo.png" width=50%>
    <div class="layer" style="text-align: center">
        <h1>Premier Pro Analytics</h1>
        <h2>
            Premier League Pro Analytics is an advanced Database & Analytics tool <br>
            <i>for Professionals by Professionals (not newbies)!</i>
        </h2>
        <h3>
            <a href="addDataFile.php" target="mainFrame">ADD DATA FILE</a><br><br>
            <a href="insertData.php" target="mainFrame">INSERT DATA</a><br>
        </h3>
    <?php
    include 'db_connection.php';
    $conn = OpenCon();

    // In case of success
    // TODO Replace goals with sum of goals

    $sql = "SELECT * 
            FROM PremierLeague;" ;

    $result = sqlsrv_query($conn, $sql);

    echo "<table>";

    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
    {
        $id = $row['id'];
        $Home = $row['Home'];
        $Away= $row['Away'];
        $notes = $row['notes'];
        $result = $row['result'];
        $season = $row['season'];
        $sum = $row['home_goals'] + $row['away_goals'];

        echo "<tr><td>$id</td></tr>";
        echo "<tr><td>$Home</td></tr>";
        echo "<tr><td>$Away</td></tr>";
        echo "<tr><td>$notes</td></tr>";
        echo "<tr><td>$result</td></tr>";
        echo "<tr><td>$season</td></tr>";
        echo "<tr><td>$sum</td></tr>";
    }

    echo "</table>";
    ?>
    </div>
</body>
</html>
