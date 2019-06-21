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

<br>

<!--    ID Input Form   -->
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <!--    Hiker ID Selection   -->
    <h2 style="font-size:20px;color:white">
        Enter Your ID
    </h2>
    <label>
        <input name="ID" type="number" size="24" required placeholder="Your ID">
    </label>
    <input type="submit" name="submit" value="Submit"/>
</form>

<!--    Query Database for relevant treks and display on map  -->
<?php
$is_empty = 0; // stores whether user exists in DB. Default = False (0)
if (isset($_POST["submit"])) {
    // ID of User
    $userID = $_POST['ID'];

    // Checks whether User ID exists in Database
    $sql = "SELECT COUNT(*) FROM Hiker WHERE Hiker.ID = '" . $userID . "'";
    $result = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
    $is_empty = $row[0];

    // If doesn't exist show message to user
    if ($is_empty == 0) {
        echo "<img src=\"user_not_exist.jpg\" alt=\"Unknown User ID\">";
    } // If exists in DB, retrieve all related trek data
    else {
        $sql = "SELECT Trek.trekName, LAT, LONG
                        FROM HikerInTrek HiT, Trek
                        WHERE HiT.trekName = Trek.trekName AND HiT.hikerID = '" . $userID . "'
                        ORDER BY HiT.startDate ASC;";
        $sql_result = sqlsrv_query($conn, $sql);
        // In case of failure
        if (!$sql_result) {
            die("<h3 style='color:darkred;'>Unexpected error. Please try again.</h3>");
        }
    }
}
?>

<!--    Map -->

<script type='text/javascript'>
    var map;

    function GetMap() {
        //Initialzing Map Obejct
        <?php

        $counter = 0; // for displaying order of treks

        // if user exists in DB ( and after pressing submit button) - shows the map
        if ($is_empty != 0) {
            echo "map = new Microsoft.Maps.Map('#myMap', {});";
        }
        ?>

        //Setting the center of the map
        map.setView({
            mapTypeId: Microsoft.Maps.MapTypeId.aerial,
            center: new Microsoft.Maps.Location(28.595, 83.819),
            zoom: 2
        });

        <?php
        // add pins to map by reading the sql query result
        while ($row = sqlsrv_fetch_array($sql_result, SQLSRV_FETCH_ASSOC)) {

            $counter = $counter + 1;
            $LAT = $row['LAT'];
            $LONG = $row['LONG'];
            $trekName = $row['trekName'];

            //--Code for adding a pin--
            echo "var center = new Microsoft.Maps.Location('" . $LAT . "', '" . $LONG . "');
                //pin definition code - replace the title with trek name and the number (according to project requirements)
                var pin = new Microsoft.Maps.Pushpin(center, {
                    title: '" . $trekName . "',
                    text: '" . $counter . "'
                });
                //Add pushpin to the map.
                map.entities.push(pin);";
            //--End of pin code--
        }
        ?>
    }
</script>
<script type='text/javascript'
        src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AvJZzTmbwvMGXaZRbr3HrfyHDxYBVVFpkxnqpzkFg6d1P8lTk6vOAEnsYqSUYJB7'></script>
<div id="mapContainer" class="standardMap" style="width:70%;height:70%">
    <div id="myMap"></div>
</div>

<!--    Close the connection -->
<?php
sqlsrv_close($conn);
?>
</body>
</html>