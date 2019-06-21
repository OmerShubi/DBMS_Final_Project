<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Trek Pro Analytics | Map</title>
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

    <!--    ID Input Form   -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <!--    Hiker File Selection   -->
        <h2 style="font-size:20px;color:white">
            Enter Your ID
        </h2>
        <label for="ID">ID</label></td>
        <label>
                <input name="ID" type="number" size="24" required placeholder="Your ID">
        </label>
        <input type="submit" name="submit" value="Submit" />
    </form>

    <!--    Query Database   -->
    <?php
        if (isset($_POST["submit"]))
        {
            // Insert data into database
            //TODO HANDLE CASE WHERE NOT EXISTS
            $userID = $_POST['ID'];

            $sql = "SELECT COUNT(*) FROM Hiker WHERE Hiker.ID = '".$userID."'";
            $result = sqlsrv_query($conn, $sql);
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
            $is_empty = $row[0];
            // Checks whether table is empty or not, to determine ID of next item
            if($is_empty == 0){
                echo "<H3 style='color: darkred'>
                        I don't know who you are. But I will find you, and I will teach you SQL!
                        </H3>";
            }
            else{
                $sql = "SELECT Trek.trekName, LAT, LONG
                        FROM HikerInTrek HiT, Trek
                        WHERE HiT.trekName = Trek.trekName AND HiT.hikerID = '".$userID."'
                        ORDER BY HiT.startDate ASC;";

                $sql_result = sqlsrv_query($conn, $sql);
                $counter = 0;
                // In case of failure
                if (!$sql_result) {
                    die("<h3 style='color:darkred;'>Unexpected error. Please try again.</h3>");
                }

                echo "GetMap()";

            }
        }
?>

    <!--    Map -->
    <script type='text/javascript'>
        var map;
        function GetMap()
        {
            //Initialzing Map Obejct
            map = new Microsoft.Maps.Map('#myMap', {});

            //Setting the center of the map - you can choose any intial center location you like.
            map.setView({
                mapTypeId: Microsoft.Maps.MapTypeId.aerial,
                center: new Microsoft.Maps.Location(28.595,83.819),
                zoom: 10
            });

            //--Code for adding a pin--
            <?php
            while($row = sqlsrv_fetch_array($sql_result, SQLSRV_FETCH_ASSOC)) {
                $counter = $counter + 1;
                $LAT = $row['LAT'];
                //add relevant trek location here - the format is Lat/Long
                echo "var center = new Microsoft.Maps.Location('".$LAT."', '".$row['LONG']."');
                //pin definition code - replace the title with trek name and the number (according to project requirements)
                var pin = new Microsoft.Maps.Pushpin(center, {
                    title: '".$row['trekName']."',
                    text: '".$counter."'
                });
                //Add pushpin to the map.
                map.entities.push(pin);";
            }
            ?>
            //--End of pin code--
        }
    </script>
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AvJZzTmbwvMGXaZRbr3HrfyHDxYBVVFpkxnqpzkFg6d1P8lTk6vOAEnsYqSUYJB7'></script>
        <div id="mapContainer" class="standardMap" style="width:50%;height:50%">
            <div id="myMap"></div></div>

    <!--    Close the connection -->
    <?php
        sqlsrv_close( $conn);
    ?>
    </body>
</html>
