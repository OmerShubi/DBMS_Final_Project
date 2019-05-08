<?php
function createTable()
{
    include 'db_connection.php';
    $conn = OpenCon();        // Connect to the database
    $sql = "
        IF (NOT EXISTS (SELECT * 
                 FROM INFORMATION_SCHEMA.TABLES 
                 WHERE TABLE_NAME = 'PremierLeague'))
        BEGIN
                 create table PremierLeague(
                                  id int primary key,
                                  Home varchar(50),
                                  Away varchar(50),
                                  notes varchar(5000),
                                  home_goals int,
                                  away_goals int,
                                  result varchar(1),
                                  season varchar(10)
             )
        END;";

    $sql_result = sqlsrv_query($conn, $sql);

    /* Close the connection. */
    sqlsrv_close($conn);
}