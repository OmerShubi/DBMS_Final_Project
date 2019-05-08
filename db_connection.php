<?php
// Connecting to the database
function OpenCon()
{
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "shubi";
    $pass = "Qwerty12!";
    $database = "shubi";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if ($conn === false) {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
    //echo "connected to DB"; //debug
    return $conn;
}
