<?php
function createTable()
{
    include 'db_connection.php';
    $conn = OpenCon();        // Connect to the database
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

    $sql_result = sqlsrv_query($conn, $sql);
    if (!$sql_result) {
        die("<h3 style='color:darkred;'>TABLE CREATION FAILED</h3>");
    }
    /* Close the connection. */
    sqlsrv_close($conn);
}