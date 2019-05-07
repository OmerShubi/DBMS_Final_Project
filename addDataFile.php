<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?php
    include 'db_connection.php';
    $conn = OpenCon();
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submit" value="submit" />

    </form>

    <?php

    if (isset($_POST["submit"])){
        // Connect to the database
            $file = $_FILES[csv][tmp_name];
            if (($handle = fopen($file, "r")) !== FALSE) {
                // Assuming first row stores column name --> skip insertion
                $data = fgetcsv($handle, 1000, ",");
                $counter = 1;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $sql="INSERT INTO PremierLeague (id, Home, Away, home_goals, away_goals, result, season, notes) VALUES 
                    ('".addslashes($counter)."','".addslashes($data[0])."','".addslashes($data[1])."','"
                        .addslashes($data[2])."','".addslashes($data[3])."','".addslashes($data[4])."','"
                        .addslashes($data[5])."','".addslashes($data[6])."'); ";
                    sqlsrv_query($conn, $sql);
                    $counter = $counter + 1;
                }
                fclose($handle);
            }
        }
    ?>
</body>
</html>
