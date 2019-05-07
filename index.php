<html lang="en">

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics</title>
    <link rel="icon" href="favicon-logo.ico"/>

</head>

<body>
    <h1 style="vertical-align: middle">
        Premier Pro
        <img src="Premier_League_Logo.png" alt="Premier League Logo">
        Analytics
    </h1>
    <div class="layer" style="text-align: center">

    <h2>
            <br>Premier League Pro Analytics is an advanced Database & Analytics tool <br><br>
            <i>for Professionals by Professionals (not newbies)!</i><br><br><br>
        </h2>
        <h3>
            <a href="addDataFile.php" target="mainFrame">ADD DATA FILE</a>
            &nbsp;&nbsp;&nbsp;
            <a href="insertData.php" target="mainFrame">INSERT DATA</a><br>
        </h3>
    <?php
    include 'db_connection.php';
    $conn = OpenCon();

    // In case of success

    $sql = "SELECT * FROM PremierLeague;" ;

    $result = sqlsrv_query($conn, $sql);
    echo '  <div id="table-scroll">';
    echo '<table style="width:70%; margin-left:15%; margin-right:15%;">';

    echo "<thead><tr><th>ID</th><th>Home</th><th>Away</th><th>Notes</th><th>Game Result</th><th>Season</th><th>Sum</th></tr></thead>";

    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
    {
        $id = $row['id'];
        $Home = $row['Home'];
        $Away= $row['Away'];
        $notes = $row['notes'];
        $game_result = $row['result'];
        $season = $row['season'];
        $sum = $row['home_goals'] + $row['away_goals'];

        echo "<tr><td>".$id."</td><td>".$Home."</td><td>".$Away."</td><td>".$notes."</td><td>".$game_result."</td><td>".$season."</td><td>".$sum."</td></tr>";
    }
    echo "</table>";
    ?>
    </div>
</body>
</html>
