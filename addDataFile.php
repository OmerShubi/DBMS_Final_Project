<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics | File</title>
</head>
<body style="text-align:center">
    <h2 style="font-size:20px;color:white">
        Whole new Database? Upload CSV File here!
    </h2>

    <?php
        include 'db_connection.php';
        $conn = OpenCon();        // Connect to the database
    ?>

<!--    File Selection   -->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submit" value="Upload" />

    </form>

<!--    Insert data into database   -->
    <?php
        if (isset($_POST["submit"]))
        {
            $file = $_FILES['csv']['tmp_name'];
            if (($handle = fopen($file, "r")) !== FALSE)
            {
                // Assuming first row stores column name --> skip insertion
                $data = fgetcsv($handle, 1000, ",");

                // Insert data into database
                $counter = 1; // Create auto incrementing id
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
