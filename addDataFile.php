<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Trek Pro Analytics | File</title>
</head>
<body style="text-align:center">

<!--    Connect to the database   -->
<?php
        include 'db_connection.php';
        $conn = OpenCon();
    ?>
    <h2 style="font-size:20px;color:white">
        Add new data below
    </h2>
    <br>

    <!--    Files Selection   -->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <!--    Hiker File Selection   -->
        <h2 style="font-size:20px;color:white">
            New Hiker Data
        </h2>
        <input name="csvHiker" type="file" id="csvHiker" accept=".csv" />
        <input type="submit" name="submitHiker" value="Upload" />
        <br>

        <!--   Trek File Selection   -->
        <h2 style="font-size:20px;color:white">
                New Trek Data
        </h2>
        <input name="csvTrek" type="file" id="csvTrek" accept=".csv" />
        <input type="submit" name="submitTrek" value="Upload" />
        <br>

        <!--   Treks in Countries (TiC) File Selection   -->
        <h2 style="font-size:20px;color:white">
                New Treks in Countries Data
        </h2>
            <input name="csvTiC" type="file" id="csvTiC" accept=".csv" />
            <input type="submit" name="submitTiC" value="Upload" />
        <br>

        <!--   Hiker in Trek (HiT) File Selection   -->
        <h2 style="font-size:20px;color:white">
        New Hikers in Treks Data
    </h2>
        <input name="csvHiT" type="file" id="csvHiT" accept=".csv" />
        <input type="submit" name="submitHiT" value="Upload" />
    </form>

    <!--    Insert Hiker data into database   -->
    <?php
        if (isset($_POST["submitHiker"]))
        {
            $file = $_FILES['csvHiker']['tmp_name'];
            if (($handle = fopen($file, "r")) !== FALSE)
            {
                // Assuming first row stores column name --> skip insertion
                $data = fgetcsv($handle, 1000, ",");
                $counter_all = 0;
                $counter_success = 0;
                // Insert data into database
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
                {
                    $sql="INSERT INTO Hiker (ID, fullName, originCountry, Smoker, Fitness) VALUES 
                    (
                     '".addslashes($data[0])."',
                     '".addslashes($data[1])."',
                     '".addslashes($data[2])."',
                     '".addslashes($data[3])."',
                     '".addslashes($data[4])."'
                     );";

                    $sql_result = sqlsrv_query($conn, $sql);

                    // In case of success
                    if($sql_result){
                        $counter_success = $counter_success + 1;
                    }

                    $counter_all = $counter_all + 1;
                }
                fclose($handle);
                echo"<h3 style='color: darkgreen'>$counter_success (out of $counter_all) records uploaded successfully!</h3>";
            }
            else{
                echo("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
            }
        }
    ?>

    <!--    Insert Trek data into database   -->
    <?php
    if (isset($_POST["submitTrek"]))
    {
        $file = $_FILES['csvTrek']['tmp_name'];
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            // Assuming first row stores column name --> skip insertion
            $data = fgetcsv($handle, 1000, ",");
            $counter_all = 0;
            $counter_success = 0;
            // Insert data into database
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $sql="INSERT INTO Trek (trekName, length, LAT, LONG) VALUES 
                    (
                     '".addslashes($data[0])."',
                     '".addslashes($data[1])."',
                     '".addslashes($data[2])."',
                     '".addslashes($data[3])."'
                     );";

                $sql_result = sqlsrv_query($conn, $sql);

                // In case of success
                if($sql_result){
                    $counter_success = $counter_success + 1;
                }

                $counter_all = $counter_all + 1;
            }
            fclose($handle);
            echo"<h3 style='color: darkgreen'>$counter_success (out of $counter_all) records uploaded successfully!</h3>";
        }
        else{
            echo("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
        }
    }
    ?>

    <!--    Insert Trek in Country data into database   -->
    <?php
    if (isset($_POST["submitTiC"]))
    {
        $file = $_FILES['csvTiC']['tmp_name'];
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            // Assuming first row stores column name --> skip insertion
            $data = fgetcsv($handle, 1000, ",");
            $counter_all = 0;
            $counter_success = 0;
            // Insert data into database
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $sql="INSERT INTO TrekInCountry (countryName, trekName) VALUES 
                    (
                     '".addslashes($data[0])."',
                     '".addslashes($data[1])."'
                     ); ";

                $sql_result = sqlsrv_query($conn, $sql);

                // In case of success
                if($sql_result){
                    $counter_success = $counter_success + 1;
                }

                $counter_all = $counter_all + 1;
            }
            fclose($handle);
            echo"<h3 style='color: darkgreen'>$counter_success (out of $counter_all) records uploaded successfully!</h3>";
        }
        else{
            echo("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
        }
    }
    ?>

    <!--    Insert Hikers in Treks data into database   -->
    <?php
    if (isset($_POST["submitHiT"]))
    {
        $file = $_FILES['csvHiT']['tmp_name'];
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            // Assuming first row stores column name --> skip insertion
            $data = fgetcsv($handle, 1000, ",");
            $counter_all = 0;
            $counter_success = 0;
            // Insert data into database
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $sql="INSERT INTO HikerInTrek (hikerID, trekName, startDate) VALUES 
                    (
                     '".addslashes($data[0])."',
                    '".addslashes($data[1])."',
                    '".addslashes($data[2])."'
                    ); ";

                $sql_result = sqlsrv_query($conn, $sql);

                // In case of success
                if($sql_result){
                    $counter_success = $counter_success + 1;
                }

                $counter_all = $counter_all + 1;
            }
            fclose($handle);
            echo"<h3 style='color: darkgreen'>$counter_success (out of $counter_all) records uploaded successfully!</h3>";
        }
        else{
            echo("<H3 style='color: darkred'>UPLOAD FAILED<br>(Should be CSV of correct format)</H3>");
        }
    }
    ?>

    <!--    Close the connection -->
    <?php
    sqlsrv_close( $conn);
    ?>
</body>
</html>
