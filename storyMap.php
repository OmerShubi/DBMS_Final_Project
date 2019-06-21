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
        $sql = "SELECT Trek.trekName, LAT, LONG
                FROM HikerInTrek HiT, Trek
                WHERE HiT.trekName = Trek.trekName AND HiT.hikerID = '".$userID."'
                ORDER BY HiT.startDate ASC;";

        $sql_result = sqlsrv_query($conn, $sql);

        // In case of failure
        if (!$sql_result) {
            die("<h3 style='color:darkred;'>Unexpected error. Please try again.</h3>");
        }

        while($row = sqlsrv_fetch_array($sql_result, SQLSRV_FETCH_ASSOC))
        {
            $trekName = $row['trekName'];
            $LAT = $row['LAT'];
            $LONG= $row['LONG'];
        }
    }
    ?>

    <!--    Map -->

    <div>
    <script type='text/javascript'>

        //In order to display the map - you will need to insert this code into your website.
        //Remember that with PHP - you can modify this code with suitable values from the database.
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

            //add relevant trek location here - the format is Lat/Long
            var center = new Microsoft.Maps.Location(28.595,83.819);
            //pin definition code - replace the title with trek name and the number (according to project requirements)
            var pin = new Microsoft.Maps.Pushpin(center, {
                title: 'Annapurna',
                text:'1'
            });
            //Add pushpin to the map.
            map.entities.push(pin);

            //In order to add more pins - all you have to do is to reuse the code above with different parameter values

            //--End of pin code--
        }
        GetMap()

    </script>
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AvJZzTmbwvMGXaZRbr3HrfyHDxYBVVFpkxnqpzkFg6d1P8lTk6vOAEnsYqSUYJB7'></script>
    <center>
        <div id="mapContainer" class="standardMap" style="width:50%;height:50%">
            <div id="myMap"></div></div>
    </div>

    <!--    Close the connection -->
    <?php
        sqlsrv_close( $conn);
    ?>
    </body>
</html>
