<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics | File</title>
</head>
<body style="text-align:center">


    <?php
        include 'db_connection.php';
        $conn = OpenCon();        // Connect to the database
    ?>
    <h2 style="font-size:20px;color:white">
        Add new data below
    </h2>

<!--    File Selection   -->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <h2 style="font-size:20px;color:white">
            New Hiker Data
        </h2>
        <input name="csv1" type="file" id="csv1" accept=".csv" />
        <input type="submit" name="submit1" value="Upload" />
        <h2 style="font-size:20px;color:white">
            New Trek Data
        </h2>
        <input name="csv2" type="file" id="csv2" accept=".csv" />
        <input type="submit" name="submit2" value="Upload" />
        <h2 style="font-size:20px;color:white">
            New Treks in Countries Data
        </h2>
        <input name="csv3" type="file" id="csv3" accept=".csv" />
        <input type="submit" name="submit3" value="Upload" />
        <h2 style="font-size:20px;color:white">
            New Hikers in Treks Data
        </h2>
        <input name="csv4" type="file" id="csv4" accept=".csv" />
        <input type="submit" name="submit4" value="Upload" />

    </form>

    <!--    Insert Hiker data into database   -->
    <?php
        if (isset($_POST["submit1"]))
        {
            $file = $_FILES['csv1']['tmp_name'];
            if (($handle = fopen($file, "r")) !== FALSE)
            {
                // Assuming first row stores column name --> skip insertion
                $data = fgetcsv($handle, 1000, ",");

                $sql = "SELECT COUNT(*) FROM PremierLeague";
                $is_empty = sqlsrv_query($conn, $sql);
                // Checks whether table is empty or not, to determine ID of next item
                if($is_empty == 0){
                    $counter = 1;
                }
                else {
                    // Get last ID, increment by one and set as new ID
                    $sql = "SELECT max(id) newID FROM PremierLeague";
                    $IDtable = sqlsrv_query($conn, $sql);
                    $row = sqlsrv_fetch_array($IDtable, SQLSRV_FETCH_ASSOC);
                    $counter = $row['newID'] + 1;
                }
                // Insert data into database
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
                {
                    $sql="INSERT INTO PremierLeague
                            (id, Home, Away, home_goals, away_goals, result, season, notes) VALUES 
                    ('".addslashes($counter)."','".addslashes($data[0])."','".addslashes($data[1])."','"
                        .addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."','"
                        .addslashes($data[5])."','".addslashes($data[6])."'); ";
                    $sql_result = sqlsrv_query($conn, $sql);
                    $counter = $counter + 1;

                    // In case of failure
                    if (!$sql_result) {
                        die("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
                    }
                }
                fclose($handle);
            }
            echo"<h3 style='color: darkgreen'>UPLOAD SUCCESSFUL</h3>";
        }
    /* Close the connection. */
    sqlsrv_close( $conn);
    ?>

    <!--    Insert Trek data into database   -->
    <?php
    if (isset($_POST["submit2"]))
    {
        $file = $_FILES['csv2']['tmp_name'];
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            // Assuming first row stores column name --> skip insertion
            $data = fgetcsv($handle, 1000, ",");

            $sql = "SELECT COUNT(*) FROM PremierLeague";
            $is_empty = sqlsrv_query($conn, $sql);
            // Checks whether table is empty or not, to determine ID of next item
            if($is_empty == 0){
                $counter = 1;
            }
            else {
                // Get last ID, increment by one and set as new ID
                $sql = "SELECT max(id) newID FROM PremierLeague";
                $IDtable = sqlsrv_query($conn, $sql);
                $row = sqlsrv_fetch_array($IDtable, SQLSRV_FETCH_ASSOC);
                $counter = $row['newID'] + 1;
            }
            // Insert data into database
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $sql="INSERT INTO PremierLeague
                            (id, Home, Away, home_goals, away_goals, result, season, notes) VALUES 
                    ('".addslashes($counter)."','".addslashes($data[0])."','".addslashes($data[1])."','"
                    .addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."','"
                    .addslashes($data[5])."','".addslashes($data[6])."'); ";
                $sql_result = sqlsrv_query($conn, $sql);
                $counter = $counter + 1;

                // In case of failure
                if (!$sql_result) {
                    die("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
                }
            }
            fclose($handle);
        }
        echo"<h3 style='color: darkgreen'>UPLOAD SUCCESSFUL</h3>";
    }
    /* Close the connection. */
    sqlsrv_close( $conn);
    ?>

    <!--    Insert Trek in Country data into database   -->
    <?php
    if (isset($_POST["submit3"]))
    {
        $file = $_FILES['csv3']['tmp_name'];
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            // Assuming first row stores column name --> skip insertion
            $data = fgetcsv($handle, 1000, ",");

            $sql = "SELECT COUNT(*) FROM PremierLeague";
            $is_empty = sqlsrv_query($conn, $sql);
            // Checks whether table is empty or not, to determine ID of next item
            if($is_empty == 0){
                $counter = 1;
            }
            else {
                // Get last ID, increment by one and set as new ID
                $sql = "SELECT max(id) newID FROM PremierLeague";
                $IDtable = sqlsrv_query($conn, $sql);
                $row = sqlsrv_fetch_array($IDtable, SQLSRV_FETCH_ASSOC);
                $counter = $row['newID'] + 1;
            }
            // Insert data into database
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $sql="INSERT INTO PremierLeague
                            (id, Home, Away, home_goals, away_goals, result, season, notes) VALUES 
                    ('".addslashes($counter)."','".addslashes($data[0])."','".addslashes($data[1])."','"
                    .addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."','"
                    .addslashes($data[5])."','".addslashes($data[6])."'); ";
                $sql_result = sqlsrv_query($conn, $sql);
                $counter = $counter + 1;

                // In case of failure
                if (!$sql_result) {
                    die("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
                }
            }
            fclose($handle);
        }
        echo"<h3 style='color: darkgreen'>UPLOAD SUCCESSFUL</h3>";
    }
    /* Close the connection. */
    sqlsrv_close( $conn);
    ?>

    <!--    Insert Hikers in Treks data into database   -->
    <?php
    if (isset($_POST["submit4"]))
    {
        $file = $_FILES['csv4']['tmp_name'];
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            // Assuming first row stores column name --> skip insertion
            $data = fgetcsv($handle, 1000, ",");

            $sql = "SELECT COUNT(*) FROM PremierLeague";
            $is_empty = sqlsrv_query($conn, $sql);
            // Checks whether table is empty or not, to determine ID of next item
            if($is_empty == 0){
                $counter = 1;
            }
            else {
                // Get last ID, increment by one and set as new ID
                $sql = "SELECT max(id) newID FROM PremierLeague";
                $IDtable = sqlsrv_query($conn, $sql);
                $row = sqlsrv_fetch_array($IDtable, SQLSRV_FETCH_ASSOC);
                $counter = $row['newID'] + 1;
            }
            // Insert data into database
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $sql="INSERT INTO PremierLeague
                            (id, Home, Away, home_goals, away_goals, result, season, notes) VALUES 
                    ('".addslashes($counter)."','".addslashes($data[0])."','".addslashes($data[1])."','"
                    .addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."','"
                    .addslashes($data[5])."','".addslashes($data[6])."'); ";
                $sql_result = sqlsrv_query($conn, $sql);
                $counter = $counter + 1;

                // In case of failure
                if (!$sql_result) {
                    die("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
                }
            }
            fclose($handle);
        }
        echo"<h3 style='color: darkgreen'>UPLOAD SUCCESSFUL</h3>";
    }
    /* Close the connection. */
    sqlsrv_close( $conn);
    ?>

</body>
</html>
