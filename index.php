<html>
  <body>
  <h1>Parts Table</h1>
    <?php
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "shubi";
    $pass = "Qwerty12!";
    $database = "shubi";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }
      $sql="SELECT * FROM Parts";
      $result = sqlsrv_query($conn, $sql);
      while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
      {
         echo $row['pid'] . " " . $row['pname'];
         echo "<br>";
      }
    ?>
  </body>
</html>