<html>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <h1>Premier Pro Analytics</h1>
    <img src="Premier_League_Logo.png" width=50%>
    <h2>
        Premier League Pro Analytics is an advanced Database & Analytics tool <br>
        <i>for Professionals by Professionals (not newbies)!</i>
    </h2>

    <?php
    include 'db_connection.php';
    $conn = OpenCon();
    // In case of success
    if (isset($_POST["submit"]))
    {
        // First insert data to the Parts table
        $sql ="INSERT INTO Parts(pid, pname, color) VALUES 
        ('".addslashes($_POST['PID'])."','".addslashes($_POST['PNAME'])."','".addslashes($_POST['COLOR'])."');";
        //echo $sql."<br>"; //debug
        $result = sqlsrv_query($conn, $sql);
        // In case of failure
        if (!$result)
        {
            die("Couldn't add the part specified.<br>");
        }

        // Now insert data to the Catalog table
        $sql = "INSERT INTO Catalog(sid,pid,cost) VALUES
        ('".addslashes($_POST['SUPID'])."','".addslashes($_POST['PID'])."','".addslashes($_POST['PRICE'])."');";
        //echo $sql."<br>"; //debug
        $result = sqlsrv_query($conn, $sql);
        // In case of failure
        if (!$result) {
            die("Couldn't add the part to the catalog.<br>");
        }
        echo "The details have been added to the database.<br><br>";
    }
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <select name="SUPID">
            <option value="">Choose Supplier...</option>
            <?php
            $sql = "SELECT * FROM Suppliers";
            $result = sqlsrv_query($conn, $sql);
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
            {
                echo "<option value=".$row['sid'].">".addslashes($row['sname'])."</option>";
            }


            ?>
        </select>
        <h2>Part Details</h2>
        <table border="0" cellpadding="5">
            <tr>
                <td>ID</td>
                <td><input name="PID" type="text" size="10"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input name="PNAME" type="text" size="20"></td>
            </tr>
            <tr>
                <td>Color</td>
                <td><input name="COLOR" type="text" size="10"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input name="PRICE" type="text" size="5"></td>
            </tr>
            <tr>
                <td colspan="2"><br><input name="submit" type="submit" value="Send"></td>
            </tr>

        </table>
    </form>
</body>
</html>
