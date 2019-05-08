<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics | Table</title>
</head>
<?php
include 'db_connection.php';
$conn = OpenCon();

// In case of success

$sql = "SELECT * FROM PremierLeague;" ;

$result = sqlsrv_query($conn, $sql);
echo '<table>';

echo "<thead><tr><th>Match ID</th><th>Home</th><th>Away</th><th>Notes</th><th>Winner</th><th>Season</th><th>Game Goals</th></tr></thead>";

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
</html>
