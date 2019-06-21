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

<!--    Files Selection   -->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

    <!--    Hiker File Selection   -->
    <h2 style="font-size:20px;color:white">
        New Hiker Data
    </h2>
    <input name="csvHiker" type="file" id="csvHiker" accept=".csv" />
    <input type="submit" name="submitHiker" value="Upload" />
</form>
?>

<!--    Close the connection -->
<?php
sqlsrv_close( $conn);
?>
</body>
</html>
